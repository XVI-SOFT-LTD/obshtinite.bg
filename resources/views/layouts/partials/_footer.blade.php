@include('layouts.partials._before_footer')

<footer class="s-footer">

    <div class="s-footer__main">
        <div class="row">
            <div class="col-two md-four mob-full s-footer__sitelinks">
                <h4>Информация</h4>
                <ul class="s-footer__linklist">
                    <li><a href="{{ route('page.show', ['slug' => 'za-nas']) }}" title="За нас">За нас</a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'kontakti']) }}" title="Контакти">Контакти</a></li>
                </ul>
            </div> <!-- end s-footer__sitelinks -->

            <div class="col-two md-four mob-full s-footer__archives">
                <h4>Категории</h4>
                <ul class="s-footer__linklist">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->i18n->name }}</a></li>
                    @endforeach
                </ul>
            </div> <!-- end s-footer__archives -->

            <div class="col-two md-four mob-full s-footer__social">
                <h4>Социални</h4>
                <ul class="s-footer__linklist">
                    <li><a href="#0">Facebook</a></li>
                    <li><a href="#0">Instagram</a></li>
                    <li><a href="#0">Twitter</a></li>
                    <li><a href="#0">Pinterest</a></li>
                    <li><a href="#0">Google+</a></li>
                    <li><a href="#0">LinkedIn</a></li>
                </ul>
            </div> <!-- end s-footer__social -->


            <div class="col-five md-full end s-footer__subscribe">
                <h4>За блога</h4>
                <p>Някаква информация която искаме да споделим с потребителите.</p>
            </div> <!-- end s-footer__subscribe -->


        </div>
    </div> <!-- end s-footer__main -->

    <div class="s-footer__bottom">
        <div class="row">
            <div class="col-full">
                <div class="s-footer__copyright">
                    <span>© Copyright Fakla.bg 2024</span>
                </div>

                <div class="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"></a>
                </div>
            </div>
        </div>
    </div> <!-- end s-footer__bottom -->

</footer> <!-- end s-footer -->


<!-- preloader
    ================================================== -->
<div id="preloader">
    <div id="loader">
        <div class="line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
