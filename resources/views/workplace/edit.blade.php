@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                    <div>
                        <h4 class="center grey-text text-darken-2 card-title">派遣先情報を更新する</h4>
                    </div>
                    <hr>
                    <div class="card-content">
                        <form action="{{route('workplaces.update', $workplace->workplace_id)}}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                {{-- workplace_id --}}
                                <input type="hidden" name="workplace_id" value="{{$workplace->workplace_id}}">
                                
                                {{-- client_id --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">assignment</i>
                                    <select name="client_id">
                                        <option value="" disabled {{old('client_id') ? '' : 'selected'}}>契約先を選択してください</option>
                                        @foreach ($clients as $client)
                                        <option value="{{$client->client_id}}" {{old('client_id') ? 'selected' : ''}}{{$workplace->wpClient==$client ? 'selected' : ''}}>{{$client->client_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>契約先</label>
                                </div>
                                {{-- workplace --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">work</i>
                                    <input type="text" name="workplace" id="workplace" value="{{old('workplace') ? : $workplace->workplace}}">
                                    <label for="workplace">派遣先</label>
                                    <span class="{{$errors->has('workplace') ? 'helper-text red-text' : ''}}">{{$errors->first('workplace')}}</span>
                                </div>
                                {{-- employee_id --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person_pin</i>
                                    <select name="employee_id">
                                        <option value="" disabled {{old('employee_id') ? '' : 'selected'}}>派遣者氏名を選択してください</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{$employee->employee_id}}" {{old('employee_id') ? 'selected' : ''}}{{$workplace->wpEmployee==$employee ? 'selected' : ''}}>{{$employee->last_name}} {{$employee->first_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>派遣者氏名</label>
                                </div>
                                {{-- amount --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input type="number" name="amount" id="amount" value="{{old('amount') ? : $workplace->amount}}">
                                    <label for="amount">金額</label>
                                    <span class="{{$errors->has('amount') ? 'helper-text red-text' : ''}}">{{$errors->first('amount')}}</span>
                                </div>
                                {{-- start_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">play_circle_outline</i>
                                    <input type="text" name="start_date" id="start_date" class="datepicker" value="{{old('start_date') ? : $workplace->start_date}}">
                                    <label for="start_date">契約開始日</label>
                                    <span class="{{$errors->has('start_date') ? 'helper-text red-text' : ''}}">{{$errors->first('start_date')}}</span>
                                </div>
                                {{-- end_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">pause_circle_outline</i>
                                    <input type="text" name="end_date" id="end_date" class="datepicker" value="{{old('end_date') ? : $workplace->end_date}}">
                                    <label for="end_date">契約終了日</label>
                                    <span class="{{$errors->has('end_date') ? 'helper-text red-text' : ''}}">{{$errors->first('end_date')}}</span>
                                </div>
                                
                                {{-- station --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">train</i>
                                    <input type="text" name="station" id="station" value="{{old('station') ? : $workplace->station}}">
                                    <label for="station">最寄り駅</label>
                                    <span class="{{$errors->has('station') ? 'helper-text red-text' : ''}}">{{$errors->first('station')}}</span>
                                </div>
                                {{-- commuting_time --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">timer</i>
                                    <input type="time" name="commuting_time" id="commuting_time" value="{{old('commuting_time') ? : $workplace->commuting_time}}">
                                    <label for="commuting_time">通勤時間</label>
                                    <span class="{{$errors->has('commuting_time') ? 'helper-text red-text' : ''}}">{{$errors->first('commuting_time')}}</span>
                                </div>
                                
                                {{-- contact_person --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person_ontline</i>
                                    <input type="text" name="contact_person" id="contact_person" value="{{old('contact_person') ? : $workplace->contact_person}}">
                                    <label for="contact_person">担当者</label>
                                    <span class="{{$errors->has('contact_person') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_person')}}</span>
                                </div>
                                {{-- contact_phone --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">local_phone</i>
                                    <input type="text" name="contact_phone" id="contact_phone" value="{{old('contact_phone') ? : $workplace->contact_phone}}" placeholder="例：00-1111-2222">
                                    <label for="contact_phone">担当者電話番号</label>
                                    <span class="{{$errors->has('contact_phone') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_phone')}}</span>
                                </div>
                                
                                {{-- contact_mail --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" name="contact_mail" id="contact_mail" value="{{old('contact_mail') ? : $workplace->contact_mail}}">
                                    <label for="contact_mail">担当者メールアドレス</label>
                                    <span class="{{$errors->has('contact_mail') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_mail')}}</span>
                                </div>
                                
                                {{-- opening_time --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">access_time</i>
                                    <input type="time" name="opening_time" id="opening_time" value="{{old('opening_time') ? : $workplace->opening_time}}">
                                    <label for="opening_time">始業時間</label>
                                    <span class="{{$errors->has('opening_time') ? 'helper-text red-text' : ''}}">{{$errors->first('opening_time')}}</span>
                                </div>
                                {{-- closing_time --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">access_time</i>
                                    <input type="time" name="closing_time" id="closing_time" value="{{old('closing_time') ? : $workplace->closing_time}}">
                                    <label for="closing_time">終業時間</label>
                                    <span class="{{$errors->has('closing_time') ? 'helper-text red-text' : ''}}">{{$errors->first('closing_time')}}</span>
                                </div>
                                
                                {{-- contracttime_floor --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">arrow_downward</i>
                                    <input type="number" name="contracttime_floor" id="contracttime_floor" value="{{old('contracttime_floor') ? : $workplace->contracttime_floor}}">
                                    <label for="contracttime_floor">契約時間下限</label>
                                    <span class="{{$errors->has('contracttime_floor') ? 'helper-text red-text' : ''}}">{{$errors->first('contracttime_floor')}}</span>
                                </div>
                                {{-- contracttime_roof --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">arrow_upward</i>
                                    <input type="number" name="contracttime_roof" id="contracttime_roof" value="{{old('contracttime_roof') ? : $workplace->contracttime_roof}}">
                                    <label for="contracttime_roof">契約時間上限</label>
                                    <span class="{{$errors->has('contracttime_roof') ? 'helper-text red-text' : ''}}">{{$errors->first('contracttime_roof')}}</span>
                                </div>
                                
                                {{-- reduction --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">sentiment_dissatisfied</i>
                                    <input type="number" name="reduction" id="reduction" value="{{old('reduction') ? : $workplace->reduction}}">
                                    <label for="reduction">時間外（減額）</label>
                                    <span class="{{$errors->has('reduction') ? 'helper-text red-text' : ''}}">{{$errors->first('reduction')}}</span>
                                </div>
                                {{-- increase --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">sentiment_satisfied</i>
                                    <input type="number" name="increase" id="increase" value="{{old('increase') ? : $workplace->increase}}">
                                    <label for="increase">時間外（増額）</label>
                                    <span class="{{$errors->has('increase') ? 'helper-text red-text' : ''}}">{{$errors->first('increase')}}</span>
                                </div>
                            </div>

                            @method('PUT')
                            @csrf()
                            <div class="row">
                                <button type="submit" name="update" class="btn teal lighten-2 waves-effect waves-light col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2">更新</button>
                                <button type="submit" name="update_log" class="btn blue lighten-2 waves-effect waves-light col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2">更新履歴保存</button>
                            </div>
                        </form>
                    </div>
                <div class="card-action">
                    <a href="/workplaces">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection