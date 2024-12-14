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
        <div class="bg-blue-100 text-blue-600 rounded-xl !p-3 !mt-2 dark:bg-blue-600/20 dark:text-blue-200 mb-2">
            <div class="flex items-center">
                <svg class="w-6 h-6 !me-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 2.5a7.5 7.5 0 100 15 7.5 7.5 0 000-15zM10 1a9 9 0 110 18 9 9 0 010-18zm0 3a1 1 0 011 1v4a1 1 0 01-2 0V5a1 1 0 011-1zm0 8a1 1 0 011 1v1a1 1 0 01-2 0v-1a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <p class="mt-3">
                    {{__('You can add Google Adsense code to your website in another placement or first add your web
                    site')}}
                    <a href="https://adsense.google.com/intl/tr_tr/start/"
                        class="text-yellow-600 underline">{{__('Google Addsense')}}</a>.
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{__('Google Adsense')}}</h4>
                @if(env('APP_STATUS') == 'Demo')
                <a class="btn btn-primary" onclick="return toastr.info('This feature is disabled in Demo version.')">Add
                    New</a>

                @else
                <a class="btn btn-primary" href="{{route('dashboard.admin.frontend.adsense.createOrUpdate')}}">Add
                    New</a>

                @endif
            </div>
            <div class="card-body">
                <div id="table-default" class="card-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('User')}}</th>
                                <th>{{__('Ad Site')}}</th>
                                <th>{{__('Ad Position')}}</th>
                                <th>{{__('Ad Client')}}</th>
                                <th>{{__('Ad Slot')}}</th>
                                <th>{{__('Ad Format')}}</th>
                                <th>{{__('Ad Status')}}</th>
                                <th>{{__('Ad Responsive')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody align-middle text-heading">

                            @foreach($adsenses as $ad)
                            <tr>
                                <td>{{$ad->user->name}}</td>
                                <td>{{substr($ad->ad_site_url, 12)}}</td>
                                <td>
                                    {!! $ad->generatePositionBadge() !!}
                                </td>
                                <td>{{$ad->ad_client}}</td>
                                <td>{{$ad->ad_slot}}</td>
                                <td>
                                    {!! $ad->generateFormatBadge() !!}
                                </td>
                                <td>
                                    {!! $ad->generateStatusBadge() !!}
                                </td>
                                <td>
                                    {!! $ad->generateResponsiveBadge() !!}
                                </td>
                                <td>
                                    {{-- copy code --}}
                                    <a onclick="copyToClipboard(`{{$ad->generateAdSenseCode()}}`)"
                                        class="btn w-[36px] h-[36px] p-0 border hover:bg-[var(--tblr-secondary)] hover:text-white"
                                        style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960"
                                            fill="var(--lqd-heading-color)" width="20">
                                            <path
                                                d="M180 975q-24 0-42-18t-18-42V312h60v603h474v60H180Zm120-120q-24 0-42-18t-18-42V235q0-24 18-42t42-18h440q24 0 42 18t18 42v560q0 24-18 42t-42 18H300Zm0-60h440V235H300v560Zm0 0V235v560Z">
                                            </path>
                                        </svg>
                                        <span class="sr-only">{{__('Copy Code')}}</span>
                                    </a>

                                    {{-- edit and delete --}}
                                    <a href="{{route('dashboard.admin.frontend.adsense.createOrUpdate', $ad->id)}}"
                                        class="btn w-[36px] h-[36px] p-0 border hover:bg-[var(--tblr-primary)] hover:text-white"
                                        title="Edit">
                                        <svg width="13" height="12" viewBox="0 0 15 14" fill="none"
                                            stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.71875 2.43988L11.9688 5.58995M10.75 11.4963H14M4.25 13.0714L12.7812 4.80248C12.9946 4.59564 13.1639 4.35009 13.2794 4.07984C13.3949 3.8096 13.4543 3.51995 13.4543 3.22744C13.4543 2.93493 13.3949 2.64528 13.2794 2.37504C13.1639 2.10479 12.9946 1.85924 12.7812 1.6524C12.5679 1.44557 12.3145 1.28149 12.0357 1.16955C11.7569 1.05761 11.458 1 11.1562 1C10.8545 1 10.5556 1.05761 10.2768 1.16955C9.99799 1.28149 9.74465 1.44557 9.53125 1.6524L1 9.92135V13.0714H4.25Z"
                                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </a>

                                    <a onclick="return confirm('Are you sure?');"
                                        href="{{route('dashboard.admin.frontend.adsense.delete', $ad->id)}}"
                                        class="btn w-[36px] h-[36px] p-0 border hover:bg-red-500 hover:text-white"
                                        title="Delete">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.08789 1.74609L5.80664 5L9.08789 8.25391L8.26758 9.07422L4.98633 5.82031L1.73242 9.07422L0.912109 8.25391L4.16602 5L0.912109 1.74609L1.73242 0.925781L4.98633 4.17969L8.26758 0.925781L9.08789 1.74609Z">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="/assets/js/panel/adsense.js"></script>
@endsection