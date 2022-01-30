@php
$spaces = App\Models\Spaces::with('categories')->get();
$blogTypes = App\Models\BlogTypes::all();
$policies = App\Models\Policies::all();
$collections = App\Models\Collections::all();
@endphp
<div class="col-md-8 hidden-sm hidden-xs">
    <nav id="primary-menu">
        <ul class="main-menu text-center">
            <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a>
            </li>
            <li class="mega-parent"><a href="{{ route('productsByCategory') }}">{{ trans('message.product') }}</a>
                <div class="mega-menu-area clearfix">
                    <div class="mega-menu-link mega-menu-link-4  f-left">
                        @foreach ($spaces as $space)
                            <ul class="single-mega-item">
                                <li class="menu-title">
                                    @if (Session::get('website_language') == 'en')
                                        {{ $space->name_en ?? $space->name_en }}
                                    @else
                                        {{ $space->name_vi }}
                                    @endif
                                </li>
                                @foreach ($space->categories as $category)
                                    <li>
                                        <a href="{{ route('productsByCategory', $category->id) }}">
                                            @if (Session::get('website_language') == 'en')
                                                {{ $category->name_en ?? $category->name_en }}
                                            @else
                                                {{ $category->name_vi }}
                                            @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </li>
            <li><a href="{{ route('productsByCollection') }}">{{ trans('message.collection') }}</a>
                <ul class="dropdwn">
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
            <li><a href="">{{ trans('message.service') }}</a>
                <ul class="dropdwn">
                    @foreach ($policies as $policy)
                        <li>
                            <a href="{{ route('policyClient', $policy->id) }}">
                                {{ $policy->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li><a href="">{{ trans('message.blog') }}</a>
                <ul class="dropdwn">
                    @foreach ($blogTypes as $blogType)
                        <li>
                            <a href="{{ route('blogList', $blogType->id) }}">{{ $blogType->title }}</a>
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
