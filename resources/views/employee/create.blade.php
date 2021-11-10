@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                <div>
                    <div>
                        <h4 class="center grey-text text-darken-2 card-title">社員情報を追加する</h4>
                    </div>
                    <hr>
                    <div class="card-content">
                        <form action="{{route('employees.store')}}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2" >
                                    <i class="material-icons prefix">format_list_numbered</i>
                                    <input type="number" name="employee_id" id="employee_id" value="{{$new_employeeid == '1' ? '1001': $new_employeeid }}">
                                    <label for="employee_id">社員ID</label>
                                    <span class="{{$errors->has('employee_id') ? 'helper-text red-text' : ''}}">{{$errors->first('employee_id')}}</span>
                                </div>

                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" name="last_name" id="last_name" value="{{Request::old('last_name') ? : ''}}">
                                    <label for="last_name">社員名字</label>
                                    <span class="{{$errors->has('last_name') ? 'helper-text red-text' : ''}}">{{$errors->first('last_name')}}</span>
                                </div>
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" name="first_name" id="first_name" value="{{Request::old('first_name') ? : ''}}">
                                    <label for="first_name">社員名前</label>
                                    <span class="{{$errors->has('first_name') ? 'helper-text red-text' : ''}}">{{$errors->first('first_name')}}</span>
                                </div>

                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" name="kana_last_name" id="kana_last_name" value="{{Request::old('kana_last_name') ? : ''}}">
                                    <label for="kana_last_name">社員名字（カナ）</label>
                                    <span class="{{$errors->has('kana_last_name') ? 'helper-text red-text' : ''}}">{{$errors->first('kana_last_name')}}</span>
                                </div>
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" name="kana_first_name" id="kana_first_name" value="{{Request::old('kana_first_name') ? : ''}}">
                                    <label for="kana_first_name">社員名前（カナ）</label>
                                    <span class="{{$errors->has('kana_first_name') ? 'helper-text red-text' : ''}}">{{$errors->first('kana_first_name')}}</span>
                                </div>
                                {{-- office --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    {{-- <i class="material-icons prefix">add_location</i>
                                    <input type="text" name="office" id="office" value="{{Request::old('office') ? : ''}}">
                                    <label for="office">所属</label>
                                    <span class="{{$errors->has('office') ? 'helper-text red-text' : ''}}">{{$errors->first('office')}}</span> --}}

                                    <i class="material-icons prefix">business</i>
                                    <select name="office">
                                        <option value="" disabled {{old('office') ? '' : 'selected'}}>所属</option>
                                        <option value="東京" {{old('office') ? 'selected' : ''}}>東京</option>
                                        <option value="沖縄">沖縄</option>
                                    </select>
                                    <label>所属</label>
                                </div>
                                {{-- postal_code --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">add_location</i>
                                    <input type="text" name="postal_code" id="postal_code" value="{{Request::old('postal_code') ? : ''}}" onKeyUp="AjaxZip3.zip2addr(this,'','address_1','address_1');" placeholder="例：0001111">
                                    <label for="postal_code">郵便番号（7桁）</label>
                                    <span class="{{$errors->has('postal_code') ? 'helper-text red-text' : ''}}">{{$errors->first('postal_code')}}</span>
                                </div>
                                {{-- address_1 --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">add_location</i>
                                    <textarea name="address_1" id="address_1" class="materialize-textarea" >{{Request::old('address_1') ? : ''}}</textarea>
                                    <label for="address_1">住所１</label>
                                    <span class="{{$errors->has('address_1') ? 'helper-text red-text' : ''}}">{{$errors->first('address_1')}}</span>
                                </div>
                                {{-- address_2 --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">add_location</i>
                                    <textarea name="address_2" id="address_2" class="materialize-textarea" >{{Request::old('address_2') ? : ''}}</textarea>
                                    <label for="address_2">住所２</label>
                                    <span class="{{$errors->has('address_2') ? 'helper-text red-text' : ''}}">{{$errors->first('address_2')}}</span>
                                </div>
                                {{-- status --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">location_city</i>
                                    <select name="status">
                                        <option value="" disabled {{old('status') ? '' : 'selected'}}>社員区分を選択してください</option>
                                        @foreach ($status as $state)
                                        <option value="{{$state->id}}" {{old('state') ? 'selected' : ''}}>{{$state->status_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>社員区分</label>
                                </div>
                                {{-- birth_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">date_range</i>
                                <input type="text" name="birth_date" id="birth_date" class="datepicker" value="{{old('birth_date') ? : ''}}" >{{Request::old('birth_date') ? : ''}}</textarea>
                                    <label for="birth_date">生年月日</label>
                                    <span class="{{$errors->has('birth_date') ? 'helper-text red-text' : ''}}">{{$errors->first('birth_date')}}</span>
                                </div>
                                {{-- gender_id --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person</i>
                                    <select name="gender">
                                        <option value="" disabled {{old('gender') ? '' : 'selected'}}>性別を選択してください</option>
                                        @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}" {{old('gender') ? 'selected' : ''}}>{{$gender->gender_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>性別</label>
                                </div>
                                {{-- blood_type --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">opacity</i>
                                    <select name="blood_type">
                                        <option value="" disabled {{old('blood_type') ? '' : 'selected'}}>血液型を選択してください</option>
                                        <option value="A" {{old('blood_type') ? 'selected' : ''}}>A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    <label>血液型</label>
                                </div>
                                {{-- phone_1 --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">local_phone</i>
                                    <input type="number" name="phone_1" id="phone_1" value="{{Request::old('phone_1') ? : ''}}">
                                    <label for="phone_1">電話番号１</label>
                                    <span class="{{$errors->has('phone_1') ? 'helper-text red-text' : ''}}">{{$errors->first('phone_1')}}</span>
                                </div>
                                {{-- phone_2 --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">local_phone</i>
                                    <input type="number" name="phone_2" id="phone_2" value="{{Request::old('phone_2') ? : ''}}">
                                    <label for="phone_2">電話番号２</label>
                                    <span class="{{$errors->has('phone_2') ? 'helper-text red-text' : ''}}">{{$errors->first('phone_2')}}</span>
                                </div>
                                {{-- mail_address --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" name="mail_address" id="mail_address" value="{{Request::old('mail_address') ? : ''}}">
                                    <label for="mail_address">メールアドレス</label>
                                    <span class="{{$errors->has('mail_address') ? 'helper-text red-text' : ''}}">{{$errors->first('mail_address')}}</span>
                                </div>
                                {{-- station --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">tram</i>
                                    <input type="text" name="station" id="station" value="{{Request::old('station') ? : ''}}">
                                    <label for="station">最寄り駅</label>
                                    <span class="{{$errors->has('station') ? 'helper-text red-text' : ''}}">{{$errors->first('station')}}</span>
                                </div>
                                {{-- commuting_route --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">tram</i>
                                    <input type="text" name="commuting_route" id="commuting_route" value="{{Request::old('commuting_route') ? : ''}}">
                                    <label for="commuting_route">通勤経路</label>
                                    <span class="{{$errors->has('commuting_route') ? 'helper-text red-text' : ''}}">{{$errors->first('commuting_route')}}</span>
                                </div>
                                {{-- fare --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input type="number" name="fare" id="fare" value="{{Request::old('fare') ? : ''}}">
                                    <label for="fare">運賃</label>
                                    <span class="{{$errors->has('fare') ? 'helper-text red-text' : ''}}">{{$errors->first('fare')}}</span>
                                </div>
                                {{-- my_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person</i>
                                    <input type="number" name="my_number" id="my_number" class="materialize-textarea" placeholder="例：000011112222">{{Request::old('my_number') ? : ''}}
                                    <label for="my_number">マイナンバー（数字のみ）</label>
                                    <span class="{{$errors->has('my_number') ? 'helper-text red-text' : ''}}">{{$errors->first('my_number')}}</span>
                                </div>
                                {{-- join_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">date_range</i>
                                <input type="text" name="join_date" id="join_date" class="datepicker" value="{{old('join_date') ? : ''}}" >{{Request::old('birth_date') ? : ''}}
                                    <label for="join_date">入社日</label>
                                    <span class="{{$errors->has('join_date') ? 'helper-text red-text' : ''}}">{{$errors->first('join_date')}}</span>
                                </div>
                                {{-- leave_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">date_range</i>
                                <input type="text" name="leave_date" id="leave_date" class="datepicker" value="{{old('leave_date') ? : ''}}" >{{Request::old('leave_date') ? : ''}}
                                    <label for="leave_date">退社日</label>
                                    <span class="{{$errors->has('leave_date') ? 'helper-text red-text' : ''}}">{{$errors->first('leave_date')}}</span>
                                </div>
                                {{-- insurance_number --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">local_hospital</i>
                                    <input type="number" name="insurance_number" id="insurance_number" value="{{Request::old('insurance_number') ? : ''}}">
                                    <label for="insurance_number">被保険者整理番号</label>
                                    <span class="{{$errors->has('insurance_number') ? 'helper-text red-text' : ''}}">{{$errors->first('insurance_number')}}</span>
                                </div>
                                {{-- reference_pension_number --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">local_hospital</i>
                                    <input type="number" name="reference_pension_number" id="reference_pension_number" value="{{Request::old('reference_pension_number') ? : ''}}">
                                    <label for="reference_pension_number">年金整理番号</label>
                                    <span class="{{$errors->has('reference_pension_number') ? 'helper-text red-text' : ''}}">{{$errors->first('reference_pension_number')}}</span>
                                </div>
                                {{-- basic_pension_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">local_hospital</i>
                                    <input type="number" name="basic_pension_number" id="basic_pension_number" value="{{Request::old('basic_pension_number') ? : ''}}" placeholder="例：0000123456">
                                    <label for="basic_pension_number">基礎年金番号（数字のみ）</label>
                                    <span class="{{$errors->has('basic_pension_number') ? 'helper-text red-text' : ''}}">{{$errors->first('basic_pension_number')}}</span>
                                </div>
                                {{-- hi_acquisition_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">date_range</i>
                                <input type="text" name="hi_acquisition_date" id="hi_acquisition_date" class="datepicker" value="{{old('hi_acquisition_date') ? : ''}}" >{{Request::old('hi_acquisition_date') ? : ''}}</textarea>
                                    <label for="hi_acquisition_date">健康保険資格 取得年月日</label>
                                    <span class="{{$errors->has('hi_acquisition_date') ? 'helper-text red-text' : ''}}">{{$errors->first('hi_acquisition_date')}}</span>
                                </div>
                                {{-- hi_loss_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">date_range</i>
                                <input type="text" name="hi_loss_date" id="hi_loss_date" class="datepicker" value="{{old('hi_loss_date') ? : ''}}" >{{Request::old('hi_loss_date') ? : ''}}</textarea>
                                    <label for="hi_loss_date">健康保険資格 喪失年月日</label>
                                    <span class="{{$errors->has('hi_loss_date') ? 'helper-text red-text' : ''}}">{{$errors->first('hi_loss_date')}}</span>
                                </div>
                                {{-- existence_of_dependents --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">opacity</i>
                                    <select name="existence_of_dependents">
                                        <option value="" disabled {{old('existence_of_dependents') ? '' : 'selected'}}>配偶者の有無を選択してください</option>
                                        <option value="1" {{old('existence_of_dependents') ? 'selected' : ''}}>有</option>
                                        <option value="0">無</option>
                                    </select>
                                    <label>配偶者の有無</label>
                                </div>
                                {{-- spouses_name --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" name="spouses_name" id="spouses_name" value="{{Request::old('spouses_name') ? : ''}}">
                                    <label for="spouses_name">配偶者氏名</label>
                                    <span class="{{$errors->has('spouses_name') ? 'helper-text red-text' : ''}}">{{$errors->first('spouses_name')}}</span>
                                </div>
                                {{-- spouses_birth_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">date_range</i>
                                <input type="text" name="spouses_birth_date" id="spouses_birth_date" class="datepicker" value="{{old('spouses_birth_date') ? : ''}}" >{{Request::old('hi_acquisition_date') ? : ''}}</textarea>
                                    <label for="spouses_birth_date">配偶者生年月日</label>
                                    <span class="{{$errors->has('spouses_birth_date') ? 'helper-text red-text' : ''}}">{{$errors->first('spouses_birth_date')}}</span>
                                </div>
                                {{-- spouses_my_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person</i>
                                    <input type="number" name="spouses_my_number" id="spouses_my_number" class="materialize-textarea" placeholder="例：000011112222">{{Request::old('spouses_my_number') ? : ''}}</textarea>
                                    <label for="spouses_my_number">配偶者個人番号（数字のみ）</label>
                                    <span class="{{$errors->has('spouses_my_number') ? 'helper-text red-text' : ''}}">{{$errors->first('spouses_my_number')}}</span>
                                </div>
                                {{-- dep1_name --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">filter_1</i>
                                    <input type="text" name="dep1_name" id="dep1_name" value="{{Request::old('dep1_name') ? : ''}}">
                                    <label for="dep1_name">扶養１ 氏名</label>
                                    <span class="{{$errors->has('dep1_name') ? 'helper-text red-text' : ''}}">{{$errors->first('dep1_name')}}</span>
                                </div>
                                {{-- dep1_birth_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_1</i>
                                <input type="text" name="dep1_birth_date" id="dep1_birth_date" class="datepicker" value="{{old('dep1_birth_date') ? : ''}}" >{{Request::old('hi_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep1_birth_date">扶養１ 生年月日</label>
                                    <span class="{{$errors->has('dep1_birth_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep1_birth_date')}}</span>
                                </div>
                                {{-- dep1_my_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_1</i>
                                    <input type="number" name="dep1_my_number" id="dep1_my_number" class="materialize-textarea" placeholder="例：000011112222">{{Request::old('dep1_my_number') ? : ''}}</textarea>
                                    <label for="dep1_my_number">扶養１ マイナンバー（数字のみ）</label>
                                    <span class="{{$errors->has('dep1_my_number') ? 'helper-text red-text' : ''}}">{{$errors->first('dep1_my_number')}}</span>
                                </div>
                                {{-- dep1_gender_id --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_1</i>
                                    <select name="dep1_gender_id">
                                        <option value="" disabled {{old('dep1_gender_id') ? '' : 'selected'}}>性別を選択してください</option>
                                        @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}" {{old('gender') ? 'selected' : ''}}>{{$gender->gender_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>扶養１ 性別</label>
                                </div>
                                {{-- dep1_relationship --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_1</i>
                                    <input type="text" name="dep1_relationship" id="dep1_relationship" class="materialize-textarea" >{{Request::old('dep1_relationship') ? : ''}}</textarea>
                                    <label for="dep1_relationship">扶養１ 続柄</label>
                                    <span class="{{$errors->has('dep1_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('dep1_relationship')}}</span>
                                </div>
                                {{-- dep1_acquisition_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_1</i>
                                <input type="text" name="dep1_acquisition_date" id="dep1_acquisition_date" class="datepicker" value="{{old('dep1_acquisition_date') ? : ''}}" >{{Request::old('dep1_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep1_acquisition_date">扶養１ 被扶養者になった日</label>
                                    <span class="{{$errors->has('dep1_acquisition_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep1_acquisition_date')}}</span>
                                </div>
                                {{-- dep1_loss_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_1</i>
                                <input type="text" name="dep1_loss_date" id="dep1_loss_date" class="datepicker" value="{{old('dep1_loss_date') ? : ''}}" >{{Request::old('dep1_loss_date') ? : ''}}</textarea>
                                    <label for="dep1_loss_date">扶養１ 被扶養者を除かれた日</label>
                                    <span class="{{$errors->has('dep1_loss_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep1_loss_date')}}</span>
                                </div>

                                {{-- dep2_name --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">filter_2</i>
                                    <input type="text" name="dep2_name" id="dep2_name" value="{{Request::old('dep2_name') ? : ''}}">
                                    <label for="dep2_name">扶養２ 氏名</label>
                                    <span class="{{$errors->has('dep2_name') ? 'helper-text red-text' : ''}}">{{$errors->first('dep2_name')}}</span>
                                </div>
                                {{-- dep2_birth_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_2</i>
                                <input type="text" name="dep2_birth_date" id="dep2_birth_date" class="datepicker" value="{{old('dep2_birth_date') ? : ''}}" >{{Request::old('hi_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep2_birth_date">扶養２ 生年月日</label>
                                    <span class="{{$errors->has('dep2_birth_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep2_birth_date')}}</span>
                                </div>
                                {{-- dep2_my_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_2</i>
                                    <input type="number" name="dep2_my_number" id="dep2_my_number" class="materialize-textarea" placeholder="例：000011112222">{{Request::old('dep2_my_number') ? : ''}}</textarea>
                                    <label for="dep2_my_number">扶養２ マイナンバー（数字のみ）</label>
                                    <span class="{{$errors->has('dep2_my_number') ? 'helper-text red-text' : ''}}">{{$errors->first('dep2_my_number')}}</span>
                                </div>
                                {{-- dep2_gender_id --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_2</i>
                                    <select name="dep2_gender_id">
                                        <option value="" disabled {{old('dep2_gender_id') ? '' : 'selected'}}>性別を選択してください</option>
                                        @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}" {{old('gender') ? 'selected' : ''}}>{{$gender->gender_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>扶養２ 性別</label>
                                </div>
                                {{-- dep2_relationship --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_2</i>
                                    <input type="text" name="dep2_relationship" id="dep2_relationship" class="materialize-textarea" >{{Request::old('dep2_relationship') ? : ''}}</textarea>
                                    <label for="dep2_relationship">扶養２ 続柄</label>
                                    <span class="{{$errors->has('dep2_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('dep2_relationship')}}</span>
                                </div>
                                {{-- dep2_acquisition_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_2</i>
                                <input type="text" name="dep2_acquisition_date" id="dep2_acquisition_date" class="datepicker" value="{{old('dep2_acquisition_date') ? : ''}}" >{{Request::old('dep2_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep2_acquisition_date">扶養２ 被扶養者になった日</label>
                                    <span class="{{$errors->has('dep2_acquisition_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep2_acquisition_date')}}</span>
                                </div>
                                {{-- dep2_loss_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_2</i>
                                <input type="text" name="dep2_loss_date" id="dep2_loss_date" class="datepicker" value="{{old('dep2_loss_date') ? : ''}}" >{{Request::old('dep2_loss_date') ? : ''}}</textarea>
                                    <label for="dep2_loss_date">扶養２ 被扶養者を除かれた日</label>
                                    <span class="{{$errors->has('dep2_loss_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep2_loss_date')}}</span>
                                </div>

                                {{-- dep3_name --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">filter_3</i>
                                    <input type="text" name="dep3_name" id="dep3_name" value="{{Request::old('dep3_name') ? : ''}}">
                                    <label for="dep3_name">扶養３ 氏名</label>
                                    <span class="{{$errors->has('dep3_name') ? 'helper-text red-text' : ''}}">{{$errors->first('dep3_name')}}</span>
                                </div>
                                {{-- dep3_birth_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_3</i>
                                <input type="text" name="dep3_birth_date" id="dep3_birth_date" class="datepicker" value="{{old('dep3_birth_date') ? : ''}}" >{{Request::old('hi_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep3_birth_date">扶養３ 生年月日</label>
                                    <span class="{{$errors->has('dep3_birth_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep3_birth_date')}}</span>
                                </div>
                                {{-- dep3_my_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_3</i>
                                    <input type="number" name="dep3_my_number" id="dep3_my_number" class="materialize-textarea" placeholder="例：000011112222">{{Request::old('dep3_my_number') ? : ''}}</textarea>
                                    <label for="dep3_my_number">扶養３ マイナンバー（数字のみ）</label>
                                    <span class="{{$errors->has('dep3_my_number') ? 'helper-text red-text' : ''}}">{{$errors->first('dep3_my_number')}}</span>
                                </div>
                                {{-- dep3_gender_id --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_3</i>
                                    <select name="dep3_gender_id">
                                        <option value="" disabled {{old('dep3_gender_id') ? '' : 'selected'}}>性別を選択してください</option>
                                        @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}" {{old('gender') ? 'selected' : ''}}>{{$gender->gender_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>扶養３ 性別</label>
                                </div>
                                {{-- dep3_relationship --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_3</i>
                                    <input type="text" name="dep3_relationship" id="dep3_relationship" class="materialize-textarea" >{{Request::old('dep3_relationship') ? : ''}}</textarea>
                                    <label for="dep3_relationship">扶養３ 続柄</label>
                                    <span class="{{$errors->has('dep3_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('dep3_relationship')}}</span>
                                </div>
                                {{-- dep3_acquisition_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_3</i>
                                <input type="text" name="dep3_acquisition_date" id="dep3_acquisition_date" class="datepicker" value="{{old('dep3_acquisition_date') ? : ''}}" >{{Request::old('dep3_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep3_acquisition_date">扶養３ 被扶養者になった日</label>
                                    <span class="{{$errors->has('dep3_acquisition_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep3_acquisition_date')}}</span>
                                </div>
                                {{-- dep3_loss_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_3</i>
                                <input type="text" name="dep3_loss_date" id="dep3_loss_date" class="datepicker" value="{{old('dep3_loss_date') ? : ''}}" >{{Request::old('dep3_loss_date') ? : ''}}</textarea>
                                    <label for="dep3_loss_date">扶養３ 被扶養者を除かれた日</label>
                                    <span class="{{$errors->has('dep3_loss_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep3_loss_date')}}</span>
                                </div>

                                {{-- dep4_name --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">filter_4</i>
                                    <input type="text" name="dep4_name" id="dep4_name" value="{{Request::old('dep4_name') ? : ''}}">
                                    <label for="dep4_name">扶養４ 氏名</label>
                                    <span class="{{$errors->has('dep4_name') ? 'helper-text red-text' : ''}}">{{$errors->first('dep4_name')}}</span>
                                </div>
                                {{-- dep4_birth_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_4</i>
                                <input type="text" name="dep4_birth_date" id="dep4_birth_date" class="datepicker" value="{{old('dep4_birth_date') ? : ''}}" >{{Request::old('hi_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep4_birth_date">扶養４ 生年月日</label>
                                    <span class="{{$errors->has('dep4_birth_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep4_birth_date')}}</span>
                                </div>
                                {{-- dep4_my_number --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_4</i>
                                    <input type="number" name="dep4_my_number" id="dep4_my_number" class="materialize-textarea" placeholder="例：000011112222">{{Request::old('dep4_my_number') ? : ''}}</textarea>
                                    <label for="dep4_my_number">扶養４ マイナンバー（数字のみ）</label>
                                    <span class="{{$errors->has('dep4_my_number') ? 'helper-text red-text' : ''}}">{{$errors->first('dep4_my_number')}}</span>
                                </div>
                                {{-- dep4_gender_id --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_4</i>
                                    <select name="dep4_gender_id">
                                        <option value="" disabled {{old('dep4_gender_id') ? '' : 'selected'}}>性別を選択してください</option>
                                        @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}" {{old('gender') ? 'selected' : ''}}>{{$gender->gender_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>扶養４ 性別</label>
                                </div>
                                {{-- dep4_relationship --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_4</i>
                                    <input type="text" name="dep4_relationship" id="dep4_relationship" class="materialize-textarea" >{{Request::old('dep4_relationship') ? : ''}}</textarea>
                                    <label for="dep4_relationship">扶養４ 続柄</label>
                                    <span class="{{$errors->has('dep4_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('dep4_relationship')}}</span>
                                </div>
                                {{-- dep4_acquisition_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">filter_4</i>
                                <input type="text" name="dep4_acquisition_date" id="dep4_acquisition_date" class="datepicker" value="{{old('dep4_acquisition_date') ? : ''}}" >{{Request::old('dep4_acquisition_date') ? : ''}}</textarea>
                                    <label for="dep4_acquisition_date">扶養４ 被扶養者になった日</label>
                                    <span class="{{$errors->has('dep4_acquisition_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep4_acquisition_date')}}</span>
                                </div>
                                {{-- dep4_loss_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">filter_4</i>
                                <input type="text" name="dep4_loss_date" id="dep4_loss_date" class="datepicker" value="{{old('dep4_loss_date') ? : ''}}" >{{Request::old('dep4_loss_date') ? : ''}}</textarea>
                                    <label for="dep4_loss_date">扶養４ 被扶養者を除かれた日</label>
                                    <span class="{{$errors->has('dep4_loss_date') ? 'helper-text red-text' : ''}}">{{$errors->first('dep4_loss_date')}}</span>
                                </div>

                                {{-- ei_number --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">accessibility</i>
                                    <input type="number" name="ei_number" id="ei_number" value="{{Request::old('ei_number') ? : ''}}" placeholder="例：00001234560">
                                    <label for="ei_number">雇用保険 被保険者整理番号（数字のみ）</label>
                                    <span class="{{$errors->has('ei_number') ? 'helper-text red-text' : ''}}">{{$errors->first('ei_number')}}</span>
                                </div>
                                {{-- ei_acquisition_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">accessibility</i>
                                <input type="text" name="ei_acquisition_date" id="ei_acquisition_date" class="datepicker" value="{{old('ei_acquisition_date') ? : ''}}" >{{Request::old('ei_acquisition_date') ? : ''}}</textarea>
                                    <label for="ei_acquisition_date">雇用保険 取得年月日</label>
                                    <span class="{{$errors->has('ei_acquisition_date') ? 'helper-text red-text' : ''}}">{{$errors->first('ei_acquisition_date')}}</span>
                                </div>
                                {{-- ei_loss_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">accessibility</i>
                                <input type="text" name="ei_loss_date" id="ei_loss_date" class="datepicker" value="{{old('ei_loss_date') ? : ''}}" >{{Request::old('dep4_loss_date') ? : ''}}</textarea>
                                    <label for="ei_loss_date">雇用保険 喪失年月日</label>
                                    <span class="{{$errors->has('ei_loss_date') ? 'helper-text red-text' : ''}}">{{$errors->first('ei_loss_date')}}</span>
                                </div>
                                {{-- ec_name --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">record_voice_over</i>
                                    <input type="text" name="ec_name" id="ec_name" value="{{Request::old('ec_name') ? : ''}}">
                                    <label for="ec_name">緊急連絡先 氏名</label>
                                    <span class="{{$errors->has('ec_name') ? 'helper-text red-text' : ''}}">{{$errors->first('ec_name')}}</span>
                                </div>
                                {{-- ec_kana_name --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">record_voice_over</i>
                                    <input type="text" name="ec_kana_name" id="ec_kana_name" value="{{Request::old('ec_kana_name') ? : ''}}">
                                    <label for="ec_kana_name">緊急連絡先 カナ</label>
                                    <span class="{{$errors->has('ec_kana_name') ? 'helper-text red-text' : ''}}">{{$errors->first('ec_kana_name')}}</span>
                                </div>
                                {{-- ec_relationship --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">record_voice_over</i>
                                    <input type="text" name="ec_relationship" id="ec_relationship" value="{{Request::old('ec_relationship') ? : ''}}">
                                    <label for="ec_relationship">緊急連絡先 本人との関係</label>
                                    <span class="{{$errors->has('ec_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('ec_relationship')}}</span>
                                </div>
                                {{-- ec_phone --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">record_voice_over</i>
                                    <input type="text" name="ec_phone" id="ec_phone" value="{{Request::old('ec_phone') ? : ''}}">
                                    <label for="ec_phone">緊急連絡先 電話番号</label>
                                    <span class="{{$errors->has('ec_phone') ? 'helper-text red-text' : ''}}">{{$errors->first('ec_phone')}}</span>
                                </div>
                                {{-- ec_address --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">record_voice_over</i>
                                    <textarea name="ec_address" id="ec_address" class="materialize-textarea" >{{Request::old('ec_address') ? : ''}}</textarea>
                                    <label for="ec_address">緊急連絡先 住所</label>
                                    <span class="{{$errors->has('ec_address') ? 'helper-text red-text' : ''}}">{{$errors->first('ec_address')}}</span>
                                </div>

                                {{-- fg1_name --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">people_outline</i>
                                    <input type="text" name="fg1_name" id="fg1_name" value="{{Request::old('fg1_name') ? : ''}}">
                                    <label for="fg1_name">身元保証人１ 氏名</label>
                                    <span class="{{$errors->has('fg1_name') ? 'helper-text red-text' : ''}}">{{$errors->first('fg1_name')}}</span>
                                </div>
                                {{-- fg1_kana_name --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">people_outline</i>
                                    <input type="text" name="fg1_kana_name" id="fg1_kana_name" value="{{Request::old('fg1_kana_name') ? : ''}}">
                                    <label for="fg1_kana_name">身元保証人１ カナ</label>
                                    <span class="{{$errors->has('fg1_kana_name') ? 'helper-text red-text' : ''}}">{{$errors->first('fg1_kana_name')}}</span>
                                </div>
                                {{-- fg1_relationship --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">people_outline</i>
                                    <input type="text" name="fg1_relationship" id="fg1_relationship" value="{{Request::old('fg1_relationship') ? : ''}}">
                                    <label for="fg1_relationship">身元保証人１ 本人との関係</label>
                                    <span class="{{$errors->has('fg1_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('fg1_relationship')}}</span>
                                </div>
                                {{-- fg1_phone --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">people_outline</i>
                                    <input type="text" name="fg1_phone" id="fg1_phone" value="{{Request::old('fg1_phone') ? : ''}}">
                                    <label for="fg1_phone">身元保証人１ 電話番号</label>
                                    <span class="{{$errors->has('fg1_phone') ? 'helper-text red-text' : ''}}">{{$errors->first('fg1_phone')}}</span>
                                </div>
                                {{-- fg1_address --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">people_outline</i>
                                    <textarea name="fg1_address" id="fg1_address" class="materialize-textarea" >{{Request::old('fg1_address') ? : ''}}</textarea>
                                    <label for="fg1_address">身元保証人１ 住所</label>
                                    <span class="{{$errors->has('fg1_address') ? 'helper-text red-text' : ''}}">{{$errors->first('fg1_address')}}</span>
                                </div>

                                {{-- fg2_name --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">people</i>
                                    <input type="text" name="fg2_name" id="fg2_name" value="{{Request::old('fg2_name') ? : ''}}">
                                    <label for="fg2_name">身元保証人２ 氏名</label>
                                    <span class="{{$errors->has('fg2_name') ? 'helper-text red-text' : ''}}">{{$errors->first('fg2_name')}}</span>
                                </div>
                                {{-- fg2_kana_name --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">people</i>
                                    <input type="text" name="fg2_kana_name" id="fg2_kana_name" value="{{Request::old('fg2_kana_name') ? : ''}}">
                                    <label for="fg2_kana_name">身元保証人２ カナ</label>
                                    <span class="{{$errors->has('fg2_kana_name') ? 'helper-text red-text' : ''}}">{{$errors->first('fg2_kana_name')}}</span>
                                </div>
                                {{-- fg2_relationship --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">people</i>
                                    <input type="text" name="fg2_relationship" id="fg2_relationship" value="{{Request::old('fg2_relationship') ? : ''}}">
                                    <label for="fg2_relationship">身元保証人２ 本人との関係</label>
                                    <span class="{{$errors->has('fg2_relationship') ? 'helper-text red-text' : ''}}">{{$errors->first('fg2_relationship')}}</span>
                                </div>
                                {{-- fg2_phone --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">people</i>
                                    <input type="text" name="fg2_phone" id="fg2_phone" value="{{Request::old('fg2_phone') ? : ''}}">
                                    <label for="fg2_phone">身元保証人２ 電話番号</label>
                                    <span class="{{$errors->has('fg2_phone') ? 'helper-text red-text' : ''}}">{{$errors->first('fg2_phone')}}</span>
                                </div>
                                {{-- fg2_address --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">people</i>
                                    <textarea name="fg2_address" id="fg2_address" class="materialize-textarea" >{{Request::old('fg2_address') ? : ''}}</textarea>
                                    <label for="fg2_address">身元保証人２ 住所</label>
                                    <span class="{{$errors->has('fg2_address') ? 'helper-text red-text' : ''}}">{{$errors->first('fg2_address')}}</span>
                                </div>

                                {{-- remark --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">assignment</i>
                                    <textarea name="remark" id="remark" class="materialize-textarea">{{Request::old('remark') ? : ''}}</textarea>
                                    <label for="remark">備考</label>
                                    <span class="{{$errors->has('remark') ? 'helper-text red-text' : ''}}">{{$errors->first('remark')}}</span>
                                </div>
                                {{-- password --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">security</i>
                                    <textarea name="password" id="password" class="materialize-textarea">{{Request::old('password') ? : ''}}</textarea>
                                    <label for="password">パスワード</label>
                                    <span class="{{$errors->has('password') ? 'helper-text red-text' : ''}}">{{$errors->first('password')}}</span>
                                </div>
                                <div class="file-field input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <div class="btn">
                                        <span>写真</span>
                                        <input type="file" name="picture">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input type="text" class="file-path validate" value="{{old('picture') ? : ''}}">
                                        <span class="{{$errors->has('picture') ? 'helpertext red-text' : '' }}">{{$errors->has('picture') ? $errors->first('picture') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                                @csrf()
                                <div class="row">
                                    <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 l4 offset-l4 xl4 offset-xl4">追加</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a href="/employees">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection