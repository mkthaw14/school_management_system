<table id="datatablesSimple" class="dataTable-table" >
    <thead >
        <tr>
            <th data-sortable="" rowspan="2" class="align-middle">
                <a href="#" class="dataTable-sorter text-center" style="width: 1px;">#</a>
            </th>
            <th data-sortable="" rowspan="2" class="align-middle" style="width: 10%;">
                <a href="#" class="dataTable-sorter text-center ">Teacher Name</a>
            </th>

                                    
            @foreach ($days as $d)
                <th data-sortable="" colspan="{{count($times)}}">
                    <a href="#" class="dataTable-sorter text-center">{{$d->name}}</a>
                </th>
            @endforeach
        </tr>

        <tr>
            @foreach ($days as $d)
                @foreach ($times as $key => $time)
                    <th data-sortable="">
                        <a href="#" class="dataTable-sorter" style="width: 80px;">{{++$key}}</a>
                    </th>   
                @endforeach   
            @endforeach
                                
        </tr>
    </thead>
                                            
    <tbody>
        <tr>
            @foreach ($teachers as $t_key => $teacher)
                <tr>
                    <td data-sortable="">{{++$t_key}}</td>
                    <td data-sortable="">{{$teacher->name}}</td>
                    @foreach ($days as $d)
                        @foreach ($times as $key => $time)
                            @php
                                $teacher_timetable = $timetable->getByTeacherIDAndDayIDAndTimeID($teacher->id, $d->id, $time->id);   
                            @endphp
                            <td data-sortable="" id="table-id-{{$key}}" style="cursor: pointer" class="table-td" data-timetable="@if($teacher_timetable){{$teacher_timetable->id}}@else{{0}}@endif" data-teachername="{{$teacher->name}}" data-dayname="{{$d->name}}" data-timename="{{$time->period}}" data-teacherid="{{$teacher->id}}" data-dayid="{{$d->id}}" data-timeid="{{$time->id}}">
                                @php
                                    if($teacher_timetable)
                                    {
                                        $section = $timetable->getSection($teacher_timetable->section_id);
                                        if($section)
                                        {
                                            $subject = $timetable->getSubject($teacher_timetable->subject_id);
                                            echo $section->grade->name."-".$section->name."<br>";
                                            echo $subject->name;

                                @endphp
                                            <input type="hidden" value="{{$section->grade->id}}" name="g-name">
                                            <input type="hidden" value="{{$section->id}}" name="sec-name">
                                            <input type="hidden" value="{{$subject->id}}" name="sub-name">
                                @php
                                        }          


                                    }
                                @endphp
                            </td>   
                        @endforeach   
                    @endforeach
                </tr>
            @endforeach                           
        </tr>
    </tbody>
</table>