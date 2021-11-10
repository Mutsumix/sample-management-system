@extends('layouts.app')
@section('content')
    <div class="container">
            <div class="card-panel grey-text text-darken-2 mt-20">
                <h4 class="grey-text text-darken-1 center">派遣先情報詳細</h4>
                    <div class="row">
                        <div class="row collection mt-20">
                            <h5 class="pl-80 mt-20">{{optional($workplace->wpClient)->client_name}}</h5>
                            <div class="col s10 offset-s1 m5 offset-m1 l5 offset-l1 xl5 offset-xl1">
                                <p class="pl-15 mt-20"><i class="material-icons left">person</i>{{optional($workplace->wpEmployee)->last_name}} {{optional($workplace->wpEmployee)->first_name ? : '未入力'}}</p>
                                <p class="pl-15 mt-20"><i class="material-icons left">train</i>{{$workplace->station ? : '未入力'}} </p>
                                <p class="pl-15 mt-20"><i class="material-icons left">person_add</i>{{optional(optional($workplace->wpEmployee)->empStatus)->status_name　? : '未入力'}} </p>
                            </div>
                            <div class="col s10 offset-s1 m5 l5 xl5">
                                <p class="pl-15 mt-20"><i class="material-icons left">monetization_on</i>{{number_format($workplace->amount) ? : '未入力'}} 円 </p>
                                <p class="pl-15 mt-20"><i class="material-icons left">play_circle_filled</i>{{$workplace->start_date ? date('Y-m-d',strtotime($workplace->start_date)): '未入力'}}</p>
                                <p class="pl-15 mt-20"><i class="material-icons left">pause_circle_filled</i>{{$workplace->start_date ? date('Y-m-d',strtotime($workplace->end_date)): '未入力'}}</p>
                            </div>
                        </div>
                        
                        <div class="collection">
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">契約開始日:</span><span class="col m8 l8 xl9">{{$workplace->start_date}}</span></p>
                            </div>
                            <div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">契約終了日:</span><span class="col m8 l8 xl9">{{$workplace->end_date}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">派遣先:</span><span class="col m8 l8 xl9">{{$workplace->workplace}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者:</span><span class="col m8 l8 xl9">{{$workplace->contact_person}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者電話番号:</span><span class="col m8 l8 xl9">{{$workplace->contact_phone}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者<br>メールアドレス:</span><span class="col m8 l8 xl9">{{$workplace->contact_mail}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">時間:</span><span class="col m8 l8 xl9">{{$workplace->contracttime_floor}} - {{$workplace->contracttime_roof}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">通勤時間:</span><span class="col m8 l8 xl9">{{$workplace->commuting_time}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">就業時間:</span><span class="col m8 l8 xl9">{{$workplace->opening_time}} - {{$workplace->closing_time}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">時間外（減額）:</span><span class="col m8 l8 xl9">{{$workplace->reduction}} 円</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">時間外（増額）:</span><span class="col m8 l8 xl9">{{$workplace->increase}} 円</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">登録日:</span><span class="col m8 l8 xl9">{{$formatted_created_at}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最終更新日:</span><span class="col m8 l8 xl9">{{$formatted_updated_at}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最終更新者:</span><span class="col m8 l8 xl9">{{$workplace->updated_by}}</span></p>
                            </div>
                        </div>
                            
                        <h4 class="grey-text text-darken-1 center">営業メモ</h4>
                        <div class="collection brown lighten-3 pb-50">
                                <div class="row flex">
                                    @foreach ($workplace->sHistories as $sHistory)
                                        <div class="col s12 m6 l6 xl6" style="margin-left: initial">
                                            {{-- Modal Trigger --}}
                                            <div class="card modal-trigger hoverable" data-target="modal{{$sHistory->shistory_id}}">
                                                <div class="card-content">
                                                    <span class="card-title ">{{$sHistory->contact_person ? $sHistory->contact_person.'氏':''}}  {{$sHistory->shistory_date}}</span>
                                                    <hr>
                                                    <p>{{$sHistory->shistory_memo}}</p>
                                                        
                                                        @if($sHistory->remind_memo != null)
                                                        <div class="row mt-10 mb-0">
                                                            <div class="center">
                                                                <div class="fusen relative">
                                                                    @if($sHistory->done_flag)
                                                                    <img src="{{asset('images/done.png')}}" class="done"> 
                                                                    @endif
                                                                    <span >
                                                                       {{$sHistory->getRemindDate()}} {{$sHistory->remind_memo}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif 
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Modal Structure --}}
                                        <div id="modal{{$sHistory->shistory_id}}" class="modal">
                                            <form action="{{route('shistories.update', $sHistory->shistory_id)}}" method="POST" enctype="multipart/form-data">
                                                <div class="modal-content"> 
                                                    <div class="row">
                                                        <div class="input-field col s12 m4 l4 xl4 ">
                                                            <textarea name="contact_person{{$sHistory->shistory_id}}" id="contact_person" class="materialize-textarea" >{{old('contact_person') ? : $sHistory->contact_person}}</textarea>
                                                            <label for="contact_person">相手担当者</label>
                                                        </div>
                                                        <div class="input-field col s12 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">
                                                            <input type="text" name="shistory_date{{$sHistory->shistory_id}}" id="shistory_date" class="datepicker" value="{{old('shistory_date') ? : $sHistory->shistory_date}}" >
                                                            <label for="shistory_date">日付</label>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <textarea class="materialize-textarea" name="shistory_memo{{$sHistory->shistory_id}}" id="shistory_memo" >{{old('shistory_memo') ? : $sHistory->shistory_memo}}</textarea>
                                                            <label for="shistory_memo">営業メモ</label>
                                                        </div>
                                                        <div class="input-field col s1 m1 l1 xl1">
                                                            <label class="active">
                                                                済 
                                                            </label>
                                                            <div class="switch">
                                                                <label for="done_flag{{$sHistory->shistory_id}}">
                                                                <input type="checkbox" name="done_flag{{$sHistory->shistory_id}}" id="done_flag{{$sHistory->shistory_id}}" {{$sHistory->done_flag ? 'checked' : ''}}>
                                                                    <span class="lever"></span>    
                                                                </label>   
                                                            </div>    
                                                        </div>
                                                        <div class="input-field col s11 m5 l5 xl5">
                                                            <textarea class="materialize-textarea" name="remind_memo{{$sHistory->shistory_id}}" id="remind_memo" >{{old('remind_memo') ? : $sHistory->remind_memo}}</textarea>
                                                            <label for="remind_memo">リマインド内容</label>
                                                        </div>
                                                        <div class="input-field col s4 m2 l2 xl2">
                                                            <input type="number" name="remind_year{{$sHistory->shistory_id}}" id="remind_year" value="{{$sHistory->remind_year ? $sHistory->remind_year : ''}}" placeholder="{{date('Y')}}">
                                                            <label for="remind_year">年</label>
                                                        </div>
                                                        <div class="input-field col s4 m2 l2 xl1">
                                                            <input type="number" name="remind_month{{$sHistory->shistory_id}}" id="remind_month" value="{{$sHistory->remind_month ? $sHistory->remind_month: ''}}" placeholder="{{date('n')}}">
                                                            <label for="remind_month">月</label>
                                                        </div>
                                                        <div class="input-field col s4 m2 l2 xl2">
                                                            <select name="remind_day{{$sHistory->shistory_id}}">
                                                                <option value="" disabled {{old('remind_day') ? '' : 'selected'}}>未選択</option>
                                                                <option value="上旬" {{$sHistory->remind_day=="上旬" ? 'selected' : ''}}>上旬</option>
                                                                <option value="中旬" {{$sHistory->remind_day=="中旬" ? 'selected' : ''}}>中旬</option>
                                                                <option value="下旬" {{$sHistory->remind_day=="下旬" ? 'selected' : ''}}>下旬</option>
                                                            </select>
                                                            <label>時期</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                @method('PUT')
                                                @csrf()
                                                <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">更新</button>
                                                </div>
                                                
                                            </form>
                                            <form action="{{route('shistories.destroy', $sHistory->shistory_id)}}" method="POST">
                                                <div class="row"> 
                                                    <div class="col s12 center"> 
                                                @method('DELETE')
                                                @csrf()
                                                <button type="submit" class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                                                    </div> 
                                                </div>
                                            </form> 
                                        </div>
                                        {{-- Modal Structure --}}
                                    @endforeach
                                </div>
                            <a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" data-target="newmodal"><i class="material-icons">add</i></a>
                        </div>

                        @if ($wphistories)
                        <h4 class="grey-text text-darken-1 center">条件更新履歴</h4>
                        <div class="collection lighten-2">
                        <div class="timeline">
                            @foreach ($wphistories as $wphistory)
                                <div class="timeline-section">
                                    <div class="timeline-date">
                                        {{date('Y/m/d',strtotime($wphistory['edit_time']))}}
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6 xl6 ">
                                            <div class="timeline-box card card-border z-depth-2 p15">
                                                {{-- <div class="box-title">
                                                    
                                                </div> --}}
                                                <div class="box-content">
                                                    <div class="box-item">
                                                        {{$wphistory['edit_item']}} を {{$wphistory['edit_value']}} に変更しました
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="box-footer">
                                                    {{$wphistory['editor']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        </div>
                        @endif
                            <button data-target="deletemodal" class="btn modal-trigger red col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2 ">削除</button>
                        <a href="{{route('workplaces.edit', $workplace->workplace_id)}}" class="btn orange col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2">更新</a>
                    </div>
            </div>
            <div class="fixed-action-btn">
                <a class="btn-floating btn-large gradient-45deg-red-pink gradient-shadow">
                  <i class="large material-icons">mode_edit</i>
                </a>
                <ul>
                  <li><a href="{{route('workplaces.copy', $workplace->workplace_id)}}" class="btn-floating green tooltipped" data-position="left" data-tooltip="コピーする"><i class="material-icons">content_copy</i></a></li>
                </ul>
              </div>
    </div>

<!-- Modal Structure of Delete Confirmation-->
<div id="deletemodal" class="modal short-modal">
    <div class="modal-content">
        <h4>💀削除確認💀</h4>
        <p>営業メモ、変更履歴も削除されますがよろしいですか？
        </p>
    </div>
    <div class="modal-footer">
        <form action="{{route('workplaces.destroy', $workplace->workplace_id)}}" method="POST">
            @method('DELETE')
            @csrf()
            <button type="submit" class="modal-action modal-close btn red btn-warning-confirm waves-effect waves-light ">削除</a>
            </form>
    </div>
</div>

{{-- Modal Structure of Add --}}
<div id="newmodal" class="modal">
    <form action="{{route('shistories.store')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="row">
                
                <input type="hidden" name="workplace_id" value="{{$workplace->workplace_id}}">
                <div class="input-field col s12 m4 l4 xl4 ">
                    <textarea name="contact_person" id="contact_person" class="materialize-textarea" >{{Request::old('contact_person') ? : ''}}</textarea>
                    <label for="contact_person">相手担当者</label>
                </div>
                <div class="input-field col s12 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">
                    <input type="text" name="shistory_date" id="shistory_date" class="datepicker" value="{{Request::old('shistory_date') ? : ''}}" >
                    <label for="shistory_date">日付</label>
                </div>
                <div class="input-field col s12">
                    <textarea class="materialize-textarea" name="shistory_memo" id="shistory_memo" >{{Request::old('shistory_memo') ? : ''}}</textarea>
                    <label for="shistory_memo">営業メモ</label>
                </div>
                <div class="input-field col s12 m6 l6 xl6">
                    <textarea class="materialize-textarea" name="remind_memo" id="remind_memo" >{{Request::old('remind_memo') ? : ''}}</textarea>
                    <label for="remind_memo">リマインド内容</label>
                </div>
                <div class="input-field col s4 m2 l2 xl2">
                    <input type="number" name="remind_year" id="remind_year" value="{{Request::old('remind_year') ? : ''}}" placeholder="{{date('Y')}}">
                    <label for="remind_year">年</label>
                </div>
                <div class="input-field col s4 m2 l2 xl1">
                    <input type="number" name="remind_month" id="remind_month" value="{{Request::old('remind_month') ? : ''}}" placeholder="{{date('n')}}">
                    <label for="remind_month">月</label>
                </div>
                <div class="input-field col s4 m2 l2 xl2">
                    <select name="remind_day">
                        <option value="" disabled {{old('remind_day') ? '' : 'selected'}}>未選択</option>
                        <option value="上旬" >上旬</option>
                        <option value="中旬" >中旬</option>
                        <option value="下旬" >下旬</option>
                    </select>
                    <label>時期</label>
                </div>
            </div>
        </div>
        @csrf()
        <div class="row">
            <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">追加</button>
        </div>
    </form>
</div>
@endsection