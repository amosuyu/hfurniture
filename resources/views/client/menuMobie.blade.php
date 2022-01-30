@php
$categories = App\Models\Categories::all();
$blogTypes = App\Models\BlogTypes::all();
$policies = App\Models\Policies::all();
$collections = App\Models\Collections::all();
@endphp
<!-- START MOBILE MENU AREA -->
<div class="mobile-menu-area hidden-lg hidden-md">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a>
                            </li>
                            <li><a href="{{ route('productsByCategory') }}">{{ trans('message.product') }}</a>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('productsByCategory', $category->id) }}">
                                                @if (Session::get('website_language') == 'en')
                                                    {{ $category->name_en ?? $category->name_en }}
                                                @else
                                                    {{ $category->name_vi }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('productsByCollection') }}">{{ trans('message.collection') }}</a>
                                <ul>
                                    @foreach ($collections as $collection)
                                        <li>
                                            <a href="{{ route('productsByCollection', $collection->id) }}">
                                                @if (Session::get('website_language') == 'en')
                                                    {{ $collection->name_en ?? $collection->name_en }}
                                                @else
                                                    {{ $collection->name_vi }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">{{ trans('message.service') }}</a>
                                <ul>
                                    @foreach ($policies as $policy)
                                        <li>
                                            <a href="{{ route('policyClient', $policy->id) }}">
                                                {{ $policy->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">{{ trans('message.blog') }}</a>
                                <ul>
                                    @foreach ($blogTypes as $blogType)
                                        <li>
                                            <a
                                                href="{{ route('blogList', $blogType->id) }}">{{ $blogType->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('aboutus') }}">{{ trans('message.about_us') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">{{ trans('message.contact') }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MOBILE MENU AREA -->
