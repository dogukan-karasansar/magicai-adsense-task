@extends('panel.layout.app')
@section('title', __('Google Adsense'))

@section('content')
<div class="page-header">
    <div class="container-xl">
        <div class="row g-2 items-center">
            <div class="col">
                <a href="{{ LaravelLocalization::localizeUrl( route('dashboard.index') ) }}"
                    class="page-pretitle flex items-center">
                    <svg class="!me-2 rtl:-scale-x-100" width="8" height="10" viewBox="0 0 6 10" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.45536 9.45539C4.52679 9.45539 4.60714 9.41968 4.66071 9.36611L5.10714 8.91968C5.16071 8.86611 5.19643 8.78575 5.19643 8.71432C5.19643 8.64289 5.16071 8.56254 5.10714 8.50896L1.59821 5.00004L5.10714 1.49111C5.16071 1.43753 5.19643 1.35718 5.19643 1.28575C5.19643 1.20539 5.16071 1.13396 5.10714 1.08039L4.66071 0.633963C4.60714 0.580392 4.52679 0.544678 4.45536 0.544678C4.38393 0.544678 4.30357 0.580392 4.25 0.633963L0.0892856 4.79468C0.0357141 4.84825 0 4.92861 0 5.00004C0 5.07146 0.0357141 5.15182 0.0892856 5.20539L4.25 9.36611C4.30357 9.41968 4.38393 9.45539 4.45536 9.45539Z" />
                    </svg>
                    {{__('Back to dashboard')}}
                </a>
                <h2 class="page-title mb-2">
                    {{__('Google Adsense')}}
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body pt-6">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form id="ad_form" onsubmit="return adsenseCreateOrUpdate({{$adsense != null ? $adsense->id : null}});"
                    action="">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_site_url') ? 'text-danger' : '')}}">{{__('Ad Site
                                            URL')}}</label>
                                        <input type="text" class="form-control" id="ad_site_url" name="ad_site_url"
                                            value="{{$adsense!=null ? $adsense->ad_site_url : null}}" required>
                                        @if($errors->has('ad_site_url'))
                                        <div class="text-danger">{{$errors->first('ad_site_url')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_position') ? 'text-danger' : '')}}">{{__('Ad
                                            Position')}}</label>
                                        <select class="form-select" id="ad_position" name="ad_position" required>
                                            <option value="">{{__('Select')}}</option>
                                            @foreach(AdPosition() as $position)
                                            <option value="{{$position}}" {{$adsense != null && $adsense->ad_position == $position? 'selected' : null}}>
                                                {{__($position->name)}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('ad_position'))
                                        <div class="text-danger">{{$errors->first('ad_position')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_client') ? 'text-danger' : '')}}">{{__('Ad
                                            Client')}}</label>
                                        <input type="text" class="form-control" id="ad_client" name="ad_client"
                                            value="{{$adsense!=null ? $adsense->ad_client : null}}" required>
                                        @if($errors->has('ad_client'))
                                        <div class="text-danger">{{$errors->first('ad_client')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_slot') ? 'text-danger' : '')}}">{{__('Ad
                                            Slot')}}</label>
                                        <input type="text" class="form-control" id="ad_slot" name="ad_slot"
                                            value="{{$adsense!=null ? $adsense->ad_slot : null}}" required>
                                        @if($errors->has('ad_slot'))
                                        <div class="text-danger">{{$errors->first('ad_slot')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_format') ? 'text-danger' : '')}}">{{__('Ad
                                            Format')}}</label>
                                        <select class="form-select" id="ad_format" name="ad_format" required>
                                            <option value="">{{__('Select')}}</option>
                                            @foreach(AdFormat() as $format)
                                            <option value="{{$format}}" {{$adsense!=null && $adsense->ad_format ==
                                                $format ? 'selected' : null}}>
                                                {{__($format->name)}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('ad_format'))
                                        <div class="text-danger">{{$errors->first('ad_format')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_status') ? 'text-danger' : '')}}">{{__('Ad
                                            Status')}}</label>
                                        <select class="form-select" id="ad_status" name="ad_status" required>
                                            <option value="">{{__('Select')}}</option>
                                            @foreach(AdStatus() as $status)
                                            <option value="{{$status}}" {{$adsense!=null && $adsense->ad_status ==
                                                $status ? 'selected' : null}}>
                                                {{__($status->name)}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('ad_status'))
                                        <div class="text-danger">{{$errors->first('ad_status')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label
                                            {{($errors->has('ad_responsive') ? 'text-danger' : '')}}">{{__('Ad
                                            Responsive')}}</label>
                                        <select class="form-select" id="ad_responsive" name="ad_responsive" required>
                                            <option value="">{{__('Select')}}</option>
                                            <option value="1" {{$adsense!=null && $adsense->ad_responsive == 1 ?
                                                'selected' : null}}>
                                                {{__('Yes')}}</option>
                                            <option value="0" {{$adsense!=null && $adsense->ad_responsive == 0 ?
                                                'selected' : null}}>
                                                {{__('No')}}</option>
                                        </select>
                                        @if($errors->has('ad_responsive'))
                                        <div class="text-danger">{{$errors->first('ad_responsive')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <button form="ad_form" id="ad_button" class="btn btn-primary w-100">
                                {{__('Save')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="/assets/js/panel/settings.js"></script>
@endsection