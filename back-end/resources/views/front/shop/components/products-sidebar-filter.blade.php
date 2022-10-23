<form action="shop">
    <div class="filter-widget">
        <h4 class="fw-title">Categories</h4>
        <ul class="filter-catagories">
            @foreach($categories as $categorie)
                <li><a href="shop/{{$categorie->name}}">{{$categorie->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Brand</h4>
        <div class="fw-brand-check">
            @foreach($brands as $brand)
                <div class="bc-item">
                    <label for="bc-{{$brand->id}}">
                        {{$brand->name}}
                        <input
                            {{ (request('brand')[$brand->id] ?? '') == 'on' ? 'checked' : ''}}
                            type="checkbox" id="bc-{{$brand->id}}" name="brand[{{$brand->id}}]"
                            onchange="this.form.submit()"
                        >
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Price</h4>
        <div class="filter-range-wrap">
            <div class="range-slider">
                <div class="price-input">
                    <input type="text" id="minamount" name="price_min">
                    <input type="text" id="maxamount" name="price_max">
                </div>
            </div>
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                 data-min="0"
                 data-max="999"
                 data-min-value="{{str_replace('$','',request('price_min'))}}"
                 data-max-value="{{str_replace('$','',request('price_max'))}}"
            >
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
        </div>
        <button type="submit" class="filter-btn">Filter</button>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Color</h4>
        <div class="fw-color-choose">
            <div class="cs-item">
                <input type="radio" id="cs-black" name="color"
                       onchange="this.form.submit()"
                       value="black"
                    {{request('color') == 'black' ? 'checked' : ''}}
                >
                <label class="cs-black" for="cs-black">black</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-violet" name="color"
                       onchange="this.form.submit()"
                       value="violet"
                    {{request('color') == 'violet' ? 'checked' : ''}}
                >
                <label class="cs-violet" for="cs-violet">violet</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-blue" name="color"
                       onchange="this.form.submit()"
                       value="blue"
                    {{request('color') == 'blue' ? 'checked' : ''}}
                >
                <label class="cs-blue" for="cs-blue">blue</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-yellow" name="color"
                       onchange="this.form.submit()"
                       value="yellow"
                    {{request('color') == 'yellow' ? 'checked' : ''}}
                >
                <label class="cs-yellow" for="cs-yellow">yellow</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-red" name="color"
                       onchange="this.form.submit()"
                       value="red"
                    {{request('color') == 'red' ? 'checked' : ''}}
                >
                <label class="cs-red" for="cs-red">red</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-green"name="color"
                       onchange="this.form.submit()"
                       value="green"
                    {{request('color') == 'green' ? 'checked' : ''}}
                >
                <label class="cs-green" for="cs-green">green</label>
            </div>
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Size</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" id="s-size" name="size" value="S"
                       onchange="this.form.submit()"
                    {{request('size')=='S' ? 'checked' : ''}}
                >
                <label for="s-size">s</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="m-size" name="size" value="M"
                       onchange="this.form.submit()"
                    {{request('size')=='M' ? 'checked' : ''}}
                >
                <label for="m-size">m</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="l-size" name="size" value="L"
                       onchange="this.form.submit()"
                    {{request('size')=='L' ? 'checked' : ''}}
                >
                <label for="l-size">l</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="xs-size" name="size" value="XS"
                       onchange="this.form.submit()"
                    {{request('size')=='XS' ? 'checked' : ''}}
                >
                <label for="xs-size">xs</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="xxs-size" name="size" value="XXS"
                       onchange="this.form.submit()"
                    {{request('size')=='XXS' ? 'checked' : ''}}
                >
                <label for="xxs-size">xxs</label>
            </div>
        </div>
    </div>
{{--    <div class="filter-widget">--}}
{{--        <h4 class="fw-title">Tags</h4>--}}
{{--        <div class="fw-tags">--}}
{{--            <a href="#">Towel</a>--}}
{{--            <a href="#">Shoes</a>--}}
{{--            <a href="#">Coat</a>--}}
{{--            <a href="#">Dresses</a>--}}
{{--            <a href="#">Trousers</a>--}}
{{--            <a href="#">Men's hats</a>--}}
{{--            <a href="#">Backpack</a>--}}
{{--        </div>--}}
{{--    </div>--}}
</form>
