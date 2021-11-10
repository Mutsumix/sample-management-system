@extends('layouts.app')
@section('content')
    <div class="container">
        {{-- <div class="row"> --}}
            <div class="card-panel grey-text text-darken-2 mt-20">
                <h4 class="grey-text text-darken-1 center">取引先情報詳細</h4>
                {{-- <div class="card-content"> --}}
                    <div class="row">
                        <div class="row collection mt-20">
                        </div>
                        
                        <div class="collection">
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">会社コード:</span><span class="col m8 l8 xl9">{{sprintf('%04d', $client->client_id)}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">会社名:</span><span class="col m8 l8 xl9">{{$client->client_name}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">会社名カナ:</span><span class="col m8 l8 xl9">{{$client->kana_client_name}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">郵便番号:</span><span class="col m8 l8 xl9">{{$client->postal_code}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">住所１:</span><span class="col m8 l8 xl9">{{$client->address_1}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">住所２:</span><span class="col m8 l8 xl9">{{$client->address_2}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">電話番号:</span><span class="col m8 l8 xl9">{{$client->phone}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">FAX:</span><span class="col m8 l8 xl9">{{$client->fax}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">メールアドレス:</span><span class="col m8 l8 xl9">{{$client->mail_address}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">URL:</span><span class="col m8 l8 xl9">{{$client->url}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">事業区分:</span><span class="col m8 l8 xl9">{{optional($client->cliCategory)->category_name}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">本社/支社:</span><span class="col m8 l8 xl9">{{$client->office}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者１ 氏名:</span><span class="col m8 l8 xl9">{{$client->contact_person_1}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者１<br>電話番号:</span><span class="col m8 l8 xl9">{{$client->contact_phone_1}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者１<br>メールアドレス:</span><span class="col m8 l8 xl9">{{$client->contact_mail_1}}</span></p>
                            </div><div class="divider"></div>

                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者２ 氏名:</span><span class="col m8 l8 xl9">{{$client->contact_person_2}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者２<br>電話番号:</span><span class="col m8 l8 xl9">{{$client->contact_phone_2}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者２<br>メールアドレス:</span><span class="col m8 l8 xl9">{{$client->contact_mail_2}}</span></p>
                            </div><div class="divider"></div>
                            
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者３ 氏名:</span><span class="col m8 l8 xl9">{{$client->contact_person_3}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者３<br>電話番号:</span><span class="col m8 l8 xl9">{{$client->contact_phone_3}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">担当者３<br>メールアドレス:</span><span class="col m8 l8 xl9">{{$client->contact_mail_3}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">締め日:</span><span class="col m8 l8 xl9">{{optional($client->cliClosingDate)->closingdate_name}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">支払日:</span><span class="col m8 l8 xl9">{{optional($client->cliPaymentDate)->paymentdate_name}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">備考:</span><span class="col m8 l8 xl9">{{$client->remark}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">登録日:</span><span class="col m8 l8 xl9">{{$formatted_created_at}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最終更新日:</span><span class="col m8 l8 xl9">{{$formatted_updated_at}}</span></p>
                            </div><div class="divider"></div>
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最終更新者:</span><span class="col m8 l8 xl9">{{$client->updated_by}}</span></p>
                            </div><div class="divider"></div>
                        </div>

                        <form action="{{route('clients.destroy', $client->client_id)}}" method="POST">
                            @method('DELETE')
                            @csrf()
                            <button type="submit" class="btn red col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2 ">削除</button>
                        </form>
                        <a href="{{route('clients.edit', $client->client_id)}}" class="btn orange col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2 ">更新</a>
                    </div>
                    {{-- <div class="card-action">
                        <a href="/categories">戻る</a>
                    </div> --}}
                {{-- </div> --}}
            </div>
        {{-- </div> --}}
    </div>
@endsection