@extends('client.layout')
@section('title', trans('message.about_us') )



@section('main')
<section class="aboutus container-fluid  mb-50">
    <div class="plr-185">
        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">{{ trans('message.about_us') }}</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                    <li>{{ trans('message.about_us') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->
        @if (Session::get('website_language') == 'en')
        <h1>Brand Story</h1>
        <p>Every detail, every product, and the image is the mark, the story that MOHO wants to convey to each customer. MOHO hopes that in each of its collections, products, and services, it will become a part of every Vietnamese family's nest, as a message of "bringing love to every living space". Towards convenience, modern minimalism, and environmental friendliness is the aspiration that MOHO constantly pursues. </p>


        <p>It is the spreading desires that turn the house into a real "home", 03/2020 Vietnamese furniture brand MOHO was shaped and born. As part of Savimex with 35 years of experience in manufacturing and exporting furniture to countries such as the US, Japan, Korea, etc., MOHO continues to inherit and promote to bring Vietnamese people furniture products 100% made in Vietnam according to international standards, ensuring health and safety but the cost is extremely reasonable.</p>
        <blockquote>
            <h2><b>SUSTAINABILITY</b> </h2>
        </blockquote>

        <p>“Sustainability” is a concept that defines development in all aspects but still ensures that development exists in a state of balance. Bringing the concept of "sustainability" into interior products and services is a pioneering and challenging step that MOHO always strives to spread and inspire a positive lifestyle, sustainable consumption. more for a green planet's future.</p>

        <h3 style="font-weight: 600;">Sustainable development goals</h3>

        <p>
            - Inspire sustainable consumption to 96 million people in Vietnam.

            - Using 100% FSC® certified wood materials - Forest Stewardship Council®.

            - Lifetime product warranty to extend product life and usefulness in the long run.

            <a href="">What is sustainable furniture and why is it important? →</a>
        </p>
    </div>
    @else
    <h1>Câu chuyện thương hiệu</h1>
    <p>Mỗi một chi tiết, mỗi một sản phẩm và hình ảnh đều là những dấu ấn, là câu chuyện mà Hfurniture muốn gửi gắm đến mỗi khách hàng. Hfurniture hi vọng trong từng bộ sưu tập, từng sản phẩm và dịch vụ của mình sẽ trở thành một phần trong tổ ấm của mỗi gia đình Việt, như một thông điệp "mang yêu thương gửi trọn trong từng không gian sống". Hướng đến sự tiện ích, hiện đại tối giản và thân thiện môi trường là khát khao mà Hfurniture không ngừng theo đuổi. </p>


    <p> Chính những khát khao lan toả biến nhà thực sự là "tổ ấm", 03/2020 Thương hiệu nội thất Việt Hfurniture được định hình và ra đời. Là một phần của Savimex với 35 kinh nghiệm trong sản xuất và xuất khẩu nội thất sang các nước như: Mỹ, Nhật, Hàn,... Hfurniture tiếp tục kế thừa và phát huy nhằm mang đến cho người Việt những sản phẩm nội thất 100% made in Vietnam theo tiêu chuẩn quốc tế, đảm bảo an toàn sức khoẻ mà chi phí lại vô cùng hợp lý. </p>
    <blockquote>
        <h2><b>HƯỚNG ĐẾN GIÁ TRỊ BỀN VỮNG</b> </h2>
    </blockquote>

    <p> “Tính bền vững” là một khái niệm định nghĩa sự phát triển về mọi mặt nhưng vẫn đảm bảo sự tồn tại phát triển ở trạng thái cân bằng. Mang khái niệm “bền vững” vào trong sản phẩm - dịch vụ nội thất là bước đi tiên phong và đầy thách thức mà Hfurniture luôn không ngừng nỗ lực nhằm lan toả, truyền cảm hứng về một lối sống tích cực, tiêu dùng bền vững hơn vì một tương lai của hành tinh xanh.</p>

    <h3 style="font-weight: 600;">Mục tiêu phát triển bền vững</h3>

    <p>
        - Truyền cảm hứng về tiêu dùng bền vững đến 96 triệu dân Việt Nam.

        - Sử dụng 100% nguồn nguyên liệu gỗ đạt chứng nhận chứng nhận FSC® - Forest Stewardship Council®.

        - Bảo hành trọn đời sản phẩm nhằm kéo dài tuổi thọ và tính hữu dụng của sản phẩm trong thời gian dài.

        <a href="">Nội thất bền vững là gì và tại sao điều này lại quan trọng? →</a>
    </p>
    </div>
    @endif



</section>
@endsection