<?php

namespace App\Imports;

use App\Models\Branche;
use App\Models\Regulation;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SubjectsImport implements ToCollection, WithLimit
{

    public $sem1 = [];
    public $sem2 = [];
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $sem1 = array();
        $sem2 = array();
        $searchForSubjectName = false;
        $subjectCol = -1;
        $creditCol = "";
        $filename =
            basename(request()->file('subjects')->getClientOriginalName(), '.' . request()->file('subjects')->getClientOriginalExtension());
        $names = explode('-', $filename);
        // dd($names);
        $branch = $names[0];
        $regulation = $names[1];
        $year = $names[2];
        // dd("year= " . $year . " reg=" . $regulation . " brach=" . $branch);
        // dump(request()->file('subjects')->getClientOriginalName());
        $sem = 1;
        foreach ($collection as $row) {
            // dump(array_search('Course Title', $row->toArray()));
            // dump($row->toArray());
            if ($searchForSubjectName == false && array_search('Subject', $row->toArray())) {
                $subjectCol = array_search('Subject', $row->toArray());
                $creditCol = array_search('Credits', $row->toArray());
                // dump('s');
                $searchForSubjectName = true;
            }
            if ($searchForSubjectName == false && array_search('Course Title', $row->toArray())) {
                $subjectCol = array_search('Course Title', $row->toArray());
                $creditCol = array_search('Credits', $row->toArray());
                $searchForSubjectName = true;
                // dd($searchForSubjectName);
            }
            if ($searchForSubjectName) {
                // dd($row);
                // dump('Subjects of year ' . $year . ' sem' . $sem);
                // dump($searchForSubjectName . '.' . $subjectCol);
            }

            if ($searchForSubjectName == true && (in_array('Total', $row->toArray(), true) || in_array('Total Credits', $row->toArray(), true))) {
                // dd(implode(',', $row->toArray()));
                $searchForSubjectName = false;
                $subjectCol = -1;
                $creditCol = "";
                $sem = 2;
            }
            if ($searchForSubjectName && $subjectCol != -1) {
                $subject = $row[$subjectCol];
                $credit = $row[$creditCol];
                if ($credit == "-") {
                    $credit = 0;
                }
                $credit = floatval($credit);
                if ($sem == 1) {

                    if (($subject != "" || $subject != null) && $subject != "Subject") {
                        array_push($sem1, ['subject' => $subject, 'credit' => $credit]);
                    }
                }
                if ($sem == 2) {

                    if (($subject != "" || $subject != null) && $subject != "Subject") {
                        array_push($sem2, ['subject' => $subject, 'credit' => $credit]);
                    }
                }
            }
            // if (preg_grep('/course\s.*/', $row->toArray())) {
            //     dump('returned');
            //     exit;
            // }
        }
        $this->data = [
            'year' => $year,
            'branch' => $branch,
            'regulation' => $regulation,
            'regulation_id' => Regulation::where('regulation', $regulation)->first()->id,
            'branch_id' => Branche::where('branch', $branch)->first()->id,
        ];
        if (count($sem1) > 0)
            $this->sem1 = $sem1;
        if (count($sem2) > 0)
            $this->sem2 = $sem2;
    }

    public function limit(): int
    {
        return 50;
    }
}
