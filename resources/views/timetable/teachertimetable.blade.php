


<div class="card mb-4" id="accordionExample">
    <div class="card-body">
        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

            <div class="dataTable-container">
                <table id="datatablesSimple" class="dataTable-table">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 19.5722%;">
                                <a href="#" class="dataTable-sorter">{{$teacher->name}}</a>
                            </th>

                            @foreach ($times as $k => $v)
                                <th data-sortable="" >
                                    <a href="#" class="dataTable-sorter">{{$v->period}}</a>
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
                                    $teacherTimetable = $timetable->getByTeacherIDAndDayIDAndTimeID($teacher->id, $day->id, $time->id);   
                                @endphp
                                <td  style="cursor: pointer" class="table-td" data-timetable="@if($teacherTimetable){{$teacherTimetable->id}}@else{{0}}@endif" data-teachername="{{$teacher->name}}" data-dayname="{{$day->name}}" data-timename="{{$time->period}}" data-teacherid="{{$teacher->id}}" data-dayid="{{$day->id}}" data-timeid="{{$time->id}}">
                                    @php
                                        if($teacherTimetable)
                                        {
                                            $section = $timetable->getSection($teacherTimetable->section_id);
                                            $subject = $timetable->getSubject($teacherTimetable->subject_id);
                                            echo $section->grade->name."-".$section->name."<br>";
                                            echo $subject->name;

                                    @endphp
                                                            <input type="hidden" value="{{$section->grade->id}}" name="g-name">
                                                            <input type="hidden" value="{{$section->id}}" name="sec-name">
                                                            <input type="hidden" value="{{$subject->id}}" name="sub-name">
                                    @php
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