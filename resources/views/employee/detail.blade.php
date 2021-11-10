@extends('layouts.app')
@section('content')
    <div class="container">
        {{-- <div class="row"> --}}
            <div class="card-panel grey-text text-darken-2 mt-20">
                <h4 class="grey-text text-darken-1 center">社員情報詳細</h4>
                    <div class="row">
                        <div class="row collection mt-20">
                            {{-- Show this image on small devices --}}
                            <div class="hide-on-med-only hide-on-large-only row">
                                <div class="col s8 offset-s2 mt-20">
                                    <img class="p5 card-panel emp-img-big" src="{{asset('images/employee_images/'.$employee->picture)}}">
                                </div>
                            </div>
                            <div class="col m8 l8 xl8">
                                <h5 class="pl-15 mt-20">{{$employee->last_name}} {{$employee->first_name}}</h5>
                                <p class="pl-15"><i class="material-icons left">business</i> {{$employee->office}}</p>
                                <p class="pl-15"><i class="material-icons left">person_outline</i> {{$age ?? ''}}</p>
                            </div>
                            {{-- Hide this image on small devices --}}
                            <div class="hide-on-small-only col m4 l4 xl3">
                                <img class="p5 card-panel emp-img-big" src="{{$employee->picture ? asset('images/employee_images/'.$employee->picture) : asset('images/no_image.png')}}">
                            </div>
                        </div>
                        
                        <div class="collection">
                            <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">社員ID:</span><span class="col m8 l8 xl9">{{$employee->employee_id}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">氏名（カナ）:</span><span class="col m8 l8 xl9">{{$employee->kana_last_name}} {{$employee->kana_first_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">所属:</span><span class="col m8 l8 xl9">{{$employee->office}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">社員区分:</span><span class="col m8 l8 xl9">{{optional($employee->empStatus)->status_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">郵便番号:</span><span class="col m8 l8 xl9">{{$employee->postal_code}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">住所１:</span><span class="col m8 l8 xl9">{{$employee->address_1}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">住所２:</span><span class="col m8 l8 xl9">{{$employee->address_2}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">生年月日:</span><span class="col m8 l8 xl9">{{$employee->birth_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">性別:</span><span class="col m8 l8 xl9">{{optional($employee->empGender)->gender_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">血液型:</span><span class="col m8 l8 xl9">{{$employee->blood_type}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">個人番号:</span><span class="col m8 l8 xl9">{{$employee->my_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">電話番号１:</span><span class="col m8 l8 xl9">{{$employee->phone_1}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">電話番号２:</span><span class="col m8 l8 xl9">{{$employee->phone_2}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">メールアドレス:</span><span class="col m8 l8 xl9">{{$employee->mail_address}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最寄り駅:</span><span class="col m8 l8 xl9">{{$employee->station}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">通勤経路:</span><span class="col m8 l8 xl9">{{$employee->commuting_route}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">運賃:</span><span class="col m8 l8 xl9">{{$employee->fare}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">入社日:</span><span class="col m8 l8 xl9">{{$employee->join_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">退社日:</span><span class="col m8 l8 xl9">{{$employee->leave_date}}</span></p>
                                </div>

                                <ul class="collapsible">
                                <li>
                                <div class="collapsible-header">
                                <i class="material-icons">arrow_drop_down</i>
                                健康保険・厚生年金情報
                                </div>
                                <div class="collapsible-body">

                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">被保険者整理番号:</span><span class="col m8 l8 xl9">{{$employee->insurance_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">年金整理番号:</span><span class="col m8 l8 xl9">{{$employee->reference_pension_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">基礎年金番号:</span><span class="col m8 l8 xl9">{{$employee->basic_pension_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">健康保険資格 取得年月日:</span><span class="col m8 l8 xl9">{{$employee->hi_acquisition_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">健康保険資格 喪失年月日:</span><span class="col m8 l8 xl9">{{$employee->hi_loss_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">被扶養者の有無:</span><span class="col m8 l8 xl9">{{$employee->existence_of_dependents}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">配偶者氏名:</span><span class="col m8 l8 xl9">{{$employee->spouses_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">配偶者生年月日:</span><span class="col m8 l8 xl9">{{$employee->spouses_birth_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">配偶者個人番号:</span><span class="col m8 l8 xl9">{{$employee->spouses_my_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 氏名:</span><span class="col m8 l8 xl9">{{$employee->dep1_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 生年月日:</span><span class="col m8 l8 xl9">{{$employee->dep1_birth_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 個人番号:</span><span class="col m8 l8 xl9">{{$employee->dep1_my_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 性別:</span><span class="col m8 l8 xl9">{{optional($employee->empDep1Gender)->gender_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 続柄:</span><span class="col m8 l8 xl9">{{$employee->dep1_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 被扶養者になった年月日:</span><span class="col m8 l8 xl9">{{$employee->dep1_acquisition_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養１ 被扶養者を除かれた年月日:</span><span class="col m8 l8 xl9">{{$employee->dep1_loss_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 氏名:</span><span class="col m8 l8 xl9">{{$employee->dep2_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 生年月日:</span><span class="col m8 l8 xl9">{{$employee->dep2_birth_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 個人番号:</span><span class="col m8 l8 xl9">{{$employee->dep2_my_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 性別:</span><span class="col m8 l8 xl9">{{optional($employee->empDep2Gender)->gender_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 続柄:</span><span class="col m8 l8 xl9">{{$employee->dep2_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 被扶養者になった年月日:</span><span class="col m8 l8 xl9">{{$employee->dep2_acquisition_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養２ 被扶養者を除かれた年月日:</span><span class="col m8 l8 xl9">{{$employee->dep2_loss_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 氏名:</span><span class="col m8 l8 xl9">{{$employee->dep3_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 生年月日:</span><span class="col m8 l8 xl9">{{$employee->dep3_birth_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 個人番号:</span><span class="col m8 l8 xl9">{{$employee->dep3_my_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 性別:</span><span class="col m8 l8 xl9">{{optional($employee->empDep3Gender)->gender_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 続柄:</span><span class="col m8 l8 xl9">{{$employee->dep3_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 被扶養者になった年月日:</span><span class="col m8 l8 xl9">{{$employee->dep3_acquisition_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養３ 被扶養者を除かれた年月日:</span><span class="col m8 l8 xl9">{{$employee->dep3_loss_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 氏名:</span><span class="col m8 l8 xl9">{{$employee->dep4_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 生年月日:</span><span class="col m8 l8 xl9">{{$employee->dep4_birth_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 個人番号:</span><span class="col m8 l8 xl9">{{$employee->dep4_my_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 性別:</span><span class="col m8 l8 xl9">{{optional($employee->empDep4Gender)->gender_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 続柄:</span><span class="col m8 l8 xl9">{{$employee->dep4_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 被扶養者になった年月日:</span><span class="col m8 l8 xl9">{{$employee->dep4_acquisition_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">扶養４ 被扶養者を除かれた年月日:</span><span class="col m8 l8 xl9">{{$employee->dep4_loss_date}}</span></p>
                                </div>

                                </div>
                                </li>
                                <li>
                                <div class="collapsible-header">
                                <i class="material-icons">arrow_drop_down</i>
                                雇用保険情報
                                </div>
                                <div class="collapsible-body">

                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">雇用保険 被保険者番号:</span><span class="col m8 l8 xl9">{{$employee->ei_number}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">雇用保険 取得年月日:</span><span class="col m8 l8 xl9">{{$employee->ei_acquisition_date}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">雇用保険 喪失年月日:</span><span class="col m8 l8 xl9">{{$employee->ei_loss_date}}</span></p>
                                </div>

                                </div>
                                </li>
                                <li>
                                <div class="collapsible-header">
                                <i class="material-icons">arrow_drop_down</i>
                                その他情報
                                </div>
                                <div class="collapsible-body">

                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">緊急連絡先 氏名:</span><span class="col m8 l8 xl9">{{$employee->ec_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">緊急連絡先 カナ:</span><span class="col m8 l8 xl9">{{$employee->ec_kana_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">緊急連絡先 本人との関係:</span><span class="col m8 l8 xl9">{{$employee->ec_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">緊急連絡先 住所:</span><span class="col m8 l8 xl9">{{$employee->ec_address}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">緊急連絡先 電話番号:</span><span class="col m8 l8 xl9">{{$employee->ec_phone}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人１ 氏名:</span><span class="col m8 l8 xl9">{{$employee->fg1_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人１ カナ:</span><span class="col m8 l8 xl9">{{$employee->fg1_kana_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人１ 本人との関係:</span><span class="col m8 l8 xl9">{{$employee->fg1_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人１ 住所:</span><span class="col m8 l8 xl9">{{$employee->fg1_address}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人１ 電話番号:</span><span class="col m8 l8 xl9">{{$employee->fg1_phone}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人２ 氏名:</span><span class="col m8 l8 xl9">{{$employee->fg2_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人２ カナ:</span><span class="col m8 l8 xl9">{{$employee->fg2_kana_name}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人２ 本人との関係:</span><span class="col m8 l8 xl9">{{$employee->fg2_relationship}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人２ 住所:</span><span class="col m8 l8 xl9">{{$employee->fg2_address}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                <p class="pl-15"><span class="bold col s5 m4 l4 xl3">身元保証人２ 電話番号:</span><span class="col m8 l8 xl9">{{$employee->fg2_phone}}</span></p>
                                </div>

                                </div>
                                </li>
                                <li>
                                <div class="collapsible-header">
                                <i class="material-icons">arrow_drop_down</i>
                                パスワード
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                    <p class="pl-15"><span class="bold col s5 m4 l4 xl3">パスワード:</span><span class="col m8 l8 xl9">{{$employee->password}}</span></p>
                                    </div>
                                </div>
                                </li>
                                </ul>

                                <div class="row">
                                    <p class="pl-15"><span class="bold col s5 m4 l4 xl3">備考:</span><span class="col m8 l8 xl9">{{$employee->remark}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                    <p class="pl-15"><span class="bold col s5 m4 l4 xl3">登録日:</span><span class="col m8 l8 xl9">{{date('Y-m-d',strtotime($employee->created_at))}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                    <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最終更新日:</span><span class="col m8 l8 xl9">{{date('Y-m-d',strtotime($employee->updated_at))}}</span></p>
                                </div><div class="divider"></div>
                                <div class="row">
                                    <p class="pl-15"><span class="bold col s5 m4 l4 xl3">最終更新者:</span><span class="col m8 l8 xl9">{{$employee->updated_by}}</span></p>
                                </div>
                        </div>

                        <form action="{{route('employees.destroy', $employee->employee_id)}}" method="POST">
                            @method('DELETE')
                            @csrf()
                            <button type="submit" class="btn red col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2 ">削除</button>
                        </form>
                        <a href="{{route('employees.edit', $employee->employee_id)}}" class="btn orange col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2 ">更新</a>
                    </div>
            </div>
    </div>
@endsection