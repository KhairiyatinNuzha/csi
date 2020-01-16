<?php

namespace App\Http\Controllers;
use App\ThesisSeminar;
use DB;
use Illuminate\Http\Request;

class ThesisSeminarController extends Controller
{
    public function index()
    {
        $thesisseminars = DB::table('thesis_seminars')
                          ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                          ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                          ->select('thesis_seminars.id', 'thesis_seminars.registered_at', 'thesis_seminars.seminar_at', 'thesis_seminars.status', DB::raw('(CASE WHEN thesis_seminars.status = 1 THEN '. "'Mengajukan'".'END) AS status_semhas'))
                          ->paginate(3);

        return view('backend.thesis_seminar.index', compact('thesisseminars'));
    }
    
    public function create()
    {
      /*$ruangan = Ruangan::all()->pluck('nama','id');
      $mahasiswa = DB::table('ta_semhas')
                  ->join('ta_sempro', 'ta_semhas.ta_sempro_id', '=' , 'ta_sempro.id')
                  ->join('tugas_akhir','ta_sempro.tugas_akhir_id', '=', 'tugas_akhir.id')
                  ->join('mahasiswa', 'tugas_akhir.mahasiswa_id', '=', 'mahasiswa.id')
                  ->select('ta_sempro.id','mahasiswa.nama')
                  ->pluck('mahasiswa.nama','ta_semhas.id');
      $rekomendasi = DB::table('ta_semhas')
                    ->select('rekomendasi', DB::raw('(CASE WHEN rekomendasi = 1 THEN '. "'Mengulang Seminar'" .'WHEN rekomendasi = 2 THEN '. "'Lanjut Sidang dengan Revisi'".'WHEN rekomendasi = 3 THEN '."'Lanjut Sidang Tanpa Revisi'".'END) AS rekomendasi_semhas'))
                    ->distinct()
                    ->pluck('rekomendasi_semhas','rekomendasi');*/
      return view('backend.thesis_seminar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'thesis_id'=>'required',
            'status' => 'required',
            'file_report' =>'file|mimes:pdf, required'
        ]);
    	    $semhas = new ThesisSeminar;
            $semhas->thesis_id = $request->thesis_id;
            $semhas->status = $request->status;
      
            if($request->hasFile('file_laporan') && $request->file('file_report')->isValid())
            {
                $filename = uniqid('laporan-');
                $fileext = $request->file('file_report')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_report->storeAs('/laporan_ta',$filenameext);
                $semhas->file_report = $filepath;
            }
            if($semhas->save()) {
                session()->flash('flash_success', 'Berhasil menambahkan pengajuan semhas baru');
                
                return redirect()->route('admin.semhas.show', [$semhas->id]);
            }
            return redirect()->back()->withErrors();
    }

    public function show($id)
    {
        $thesisseminars = DB::table('thesis_seminars')
                ->join('thesis_sem_reviewers', 'thesis_seminars.id', '=', 'thesis_sem_reviewers.thesis_seminar_id')
                ->join('lecturers', 'thesis_sem_reviewers.reviewer_id', '=', 'lecturers.id')
                ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                ->join('students', 'theses.student_id', '=', 'students.id')
           
                ->select('thesis_proposals.id','students.name AS student_name','thesis_seminars.registered_at AS registered_time','thesis_seminars.seminar_at AS seminar_time','thesis_seminars.status','thesis_seminars.recommendation','thesis_seminars.file_report AS file_reports', 'lecturers.name AS reviewer_name', DB::raw('(CASE WHEN thesis_seminars.status = 1 THEN '. "'Mengajukan'" .'END) AS status_semhas'))

                ->where('thesis_seminars.id','=',$id)
                ->get();
                  
        $thesisseminars = $thesisseminars[0];
  
        return view('backend.thesis_seminar.show', compact('thesisseminars'));
    }

    public function destroy($id)
    {
        $a = db::table('thesis_sem_audiences')
        ->where('thesis_seminar_id','=',$id);
        $a->delete();
        $b = db::table('thesis_sem_reviewers')
        ->where('thesis_seminar_id','=',$id);
        $b->delete();
        $thesisseminars = DB::table('thesis_seminars')
        // ->join('thesis_sem_audiences', 'thesis_seminars.id', '=', 'thesis_sem_audiences.thesis_seminar_id')
        // ->join('thesis_sem_reviewers', 'thesis_seminars.id', '=', 'thesis_sem_reviewers.thesis_seminar_id')
        ->where('thesis_seminars.id','=',$id);
        $thesisseminars->delete();
        session()->flash('flash_success', 'Berhasil membatalkan pengajuan semhas');
        return redirect()->route('admin.semhas.index');
    }
}
