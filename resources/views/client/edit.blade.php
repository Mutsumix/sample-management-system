@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                {{-- <div> --}}
                    <div>
                        <h4 class="center grey-text text-darken-2 card-title">取引先情報を更新する</h4>
                    </div>
                    <hr>
                    <div class="card-content">
                        <form action="{{route('clients.update', $client->client_id)}}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">format_list_numbered</i>
                                    <input type="number" name="client_id" id="client_id" value="{{old('client_id') ? : $client->client_id}}" readonly>
                                    <label for="client_id">取引先CD</label>
                                    <span class="{{$errors->has('client_id') ? 'helper-text red-text' : ''}}">{{$errors->first('client_id')}}</span>
                                </div>
                        {{-- client_name --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">apartment</i>
                                    <input type="text" name="client_name" id="client_name" value="{{old('client_name') ? : $client->client_name}}">
                                    <label for="client_name">取引先名</label>
                                    <span class="{{$errors->has('client_name') ? 'helper-text red-text' : ''}}">{{$errors->first('client_name')}}</span>
                                </div>
                        {{-- kana_client_name --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">apartment</i>
                                    <input type="text" name="kana_client_name" id="kana_client_name" value="{{old('kana_client_name') ? : $client->kana_client_name}}">
                                    <label for="kana_client_name">取引先名（カナ）</label>
                                    <span class="{{$errors->has('kana_client_name') ? 'helper-text red-text' : ''}}">{{$errors->first('kana_client_name')}}</span>
                                </div>
                        {{-- postal code --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">add_location</i>
                                    <input type="text" name="postal_code" id="postal_code" value="{{old('postal_code') ? : $client->postal_code}}" onKeyUp="AjaxZip3.zip2addr(this,'','address_1','address_1');">
                                    <label for="postal_code">郵便番号（7桁）</label>
                                    <span class="{{$errors->has('postal_code') ? 'helper-text red-text' : ''}}">{{$errors->first('postal_code')}}</span>
                                </div>
                        {{-- address_1 --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">add_location</i>
                                    <textarea name="address_1" id="address_1" class="materialize-textarea" >{{old('address_1') ? : $client->address_1}}</textarea>
                                    <label for="address_1">住所１</label>
                                    <span class="{{$errors->has('address_1') ? 'helper-text red-text' : ''}}">{{$errors->first('address_1')}}</span>
                                </div>
                        {{-- address_2 --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">add_location</i>
                                    <textarea name="address_2" id="address_2" class="materialize-textarea" >{{old('address_2') ? : $client->address_2}}</textarea>
                                    <label for="address_2">住所２</label>
                                    <span class="{{$errors->has('address_2') ? 'helper-text red-text' : ''}}">{{$errors->first('address_2')}}</span>
                                </div>
                        {{-- phone --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">local_phone</i>
                                    <input type="number" name="phone" id="phone" value="{{old('phone') ? : $client->phone}}">
                                    <label for="phone">電話番号</label>
                                    <span class="{{$errors->has('phone') ? 'helper-text red-text' : ''}}">{{$errors->first('phone')}}</span>
                                </div>
                        {{-- fax --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">contact_phone</i>
                                    <input type="number" name="fax" id="fax" value="{{old('fax') ? : $client->fax}}">
                                    <label for="fax">FAX</label>
                                    <span class="{{$errors->has('fax') ? 'helper-text red-text' : ''}}">{{$errors->first('fax')}}</span>
                                </div>
                        {{-- mail_address --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" name="mail_address" id="mail_address" value="{{old('mail_address') ? : $client->mail_address}}">
                                    <label for="mail_address">メールアドレス</label>
                                    <span class="{{$errors->has('mail_address') ? 'helper-text red-text' : ''}}">{{$errors->first('mail_address')}}</span>
                                </div>
                        {{-- office --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">device_hub</i>
                                    <select name="office">
                                        <option value=""  {{old('office') ? '' : 'selected'}}>本社/支社を選択してください</option>
                                        <option value="本社" {{$client->office=='本社' ? 'selected' : ''}}>本社</option>
                                        <option value="支社" {{$client->office=='支社' ? 'selected' : ''}}>支社</option>
                                    </select>
                                    <label>本社/支社</label>
                                </div>

                                {{-- contact_person_1 --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input type="text" name="contact_person_1" id="contact_person_1" value="{{old('contact_person_1') ? : $client->contact_person_1}}">
                                    <label for="contact_person_1">担当者１ 氏名</label>
                                    <span class="{{$errors->has('contact_person_1') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_person_1')}}</span>
                                </div>
                                {{-- contact_phone_1 --}}
                                        <div class="input-field col s12 m4 l4 xl4">
                                            <i class="material-icons prefix">person_pin</i>
                                            <input type="number" name="contact_phone_1" id="local_phone" value="{{old('contact_phone_1') ? : $client->contact_phone_1}}">
                                            <label for="contact_phone_1">担当者１ 電話番号</label>
                                            <span class="{{$errors->has('contact_phone_1') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_phone_1')}}</span>
                                        </div>
                                {{-- contact_mail_1 --}}
                                        <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                            <i class="material-icons prefix">email</i>
                                            <input type="email" name="contact_mail_1" id="contact_mail_1" value="{{old('contact_mail_1') ? : $client->contact_mail_1}}">
                                            <label for="contact_mail_1">担当者１ メールアドレス</label>
                                            <span class="{{$errors->has('contact_mail_1') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_mail_1')}}</span>
                                        </div>
                                        
                                {{-- contact_person_2 --}}
                                        <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                            <i class="material-icons prefix">person_pin</i>
                                            <input type="text" name="contact_person_2" id="contact_person_2" value="{{old('contact_person_2') ? : $client->contact_person_2}}">
                                            <label for="contact_person_2">担当者２ 氏名</label>
                                            <span class="{{$errors->has('contact_person_2') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_person_2')}}</span>
                                        </div>
                                {{-- contact_phone_2 --}}
                                        <div class="input-field col s12 m4 l4 xl4">
                                            <i class="material-icons prefix">person_pin</i>
                                            <input type="number" name="contact_phone_2" id="local_phone" value="{{old('contact_phone_2') ? : $client->contact_phone_2}}">
                                            <label for="contact_phone_2">担当者２ 電話番号</label>
                                            <span class="{{$errors->has('contact_phone_2') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_phone_2')}}</span>
                                        </div>
                                {{-- contact_mail_2 --}}
                                        <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                            <i class="material-icons prefix">email</i>
                                            <input type="email" name="contact_mail_2" id="contact_mail_2" value="{{old('contact_mail_2') ? : $client->contact_mail_2}}">
                                            <label for="contact_mail_2">担当者２ メールアドレス</label>
                                            <span class="{{$errors->has('contact_mail_2') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_mail_2')}}</span>
                                        </div>

                                {{-- contact_person_3 --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input type="text" name="contact_person_3" id="contact_person_3" value="{{old('contact_person_3') ? : $client->contact_person_3}}">
                                    <label for="contact_person_3">担当者３ 氏名</label>
                                    <span class="{{$errors->has('contact_person_3') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_person_3')}}</span>
                                </div>
                                {{-- contact_phone_3 --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input type="number" name="contact_phone_3" id="local_phone" value="{{old('contact_phone_3') ? : $client->contact_phone_3}}">
                                    <label for="contact_phone_3">担当者３ 電話番号</label>
                                    <span class="{{$errors->has('contact_phone_3') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_phone_3')}}</span>
                                </div>
                                {{-- contact_mail_3 --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" name="contact_mail_3" id="contact_mail_3" value="{{old('contact_mail_3') ? : $client->contact_mail_3 }}">
                                    <label for="contact_mail_3">担当者３ メールアドレス</label>
                                    <span class="{{$errors->has('contact_mail_3') ? 'helper-text red-text' : ''}}">{{$errors->first('contact_mail_3')}}</span>
                                </div>
                                {{-- closing_date --}}
                                <div class="input-field col s12 m4 offset-m2 l4 offset-l2 xl4 offset-xl2">
                                    <i class="material-icons prefix">skip_next</i>
                                    <select name="closing_date">
                                        <option value=""  {{old('closing_date') ? '' : 'selected'}}>締め日を選択してください</option>
                                        @foreach ($closingdates as $closingdate)
                                        <option value="{{$closingdate->id}}" {{old('category') ? 'selected' : ''}}{{$client->cliClosingDate==$closingdate ? 'selected' : ''}}>{{$closingdate->closingdate_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>締め日</label>
                                    {{-- <span class="{{$errors->has('closingdate') ? 'helper-text red-text' : ''}}">{{$errors->has('closingdate')}}</span> --}}
                                </div>
                                {{-- payment_date --}}
                                <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">attach_money</i>
                                    <select name="payment_date">
                                        <option value=""  {{old('payment_date') ? '' : 'selected'}}>支払日を選択してください</option>
                                        @foreach ($paymentdates as $paymentdate)
                                        <option value="{{$paymentdate->id}}" {{old('category') ? 'selected' : ''}}{{$client->cliPaymentDate==$paymentdate ? 'selected':''}}>{{$paymentdate->paymentdate_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>支払日</label>
                                    {{-- <span class="{{$errors->has('paymentdate') ? 'helper-text red-text' : ''}}">{{$errors->has('paymentdate')}}</span> --}}
                                </div>
                                {{-- remark --}}
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">assignment</i>
                                    <textarea name="remark" id="remark" class="materialize-textarea">{{old('remark') ? : $client->remark}}</textarea>
                                    <label for="remark">備考（営業履歴等）</label>
                                    <span class="{{$errors->has('remark') ? 'helper-text red-text' : ''}}">{{$errors->first('remark')}}</span>
                                </div>
                            </div>

                            @method('PUT')
                            @csrf()
                            <div class="row">
                                <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 l4 offset-l4 xl4 offset-xl4">更新</button>
                            </div>
                        </form>
                    </div>
                {{-- </div> --}}
                <div class="card-action">
                    <a href="/clients">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection