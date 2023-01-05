<div class="card mb-4" id="accordionExample">
    <div class="card-body">
        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

            <div class="dataTable-container">
                <table id="datatablesSimple" class="dataTable-table table">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 19.5722%; color:black;" >
                                {{$section->grade->academic_year->yearOne." ".$section->grade->name." Section "."-".$section->name}}
                            </th>

                            @foreach ($times as $k => $v)
                                <th data-sortable="" style="color:black">
                                    {{$v->period}}
                                </th>
                            @endforeach
                        </tr>
                    </thead>                         
                    <tbody>
                        @foreach ($days as $k => $day)
                            <tr>
                                <td>{{$day->name}}</td>
                                @foreach ($times as $time_key => $time)

                                @php
                                    $sectionTimetable = $timetable->getBySectionIDAndDayIDAndTimeID($section->id, $day->id, $time->id);   
                                @endphp
                                <td>
                                    @php
                                        if($sectionTimetable)
                                        {
                                            $teacher = $timetable->getTeacher($sectionTimetable->teacher_id);
                                            $subject = $timetable->getSubject($sectionTimetable->subject_id);
                                            //echo $section->grade->name."-".$section->name."<br>";
                                            echo $subject->name."<br>";
                                            echo $teacher->name;
                                        }
                                    @endphp
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="dataTable-bottom">

                    <nav class="dataTable-pagination">

                    </nav>
                </div>
            </div>
        </div>
    </div>
