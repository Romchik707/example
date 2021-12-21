@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="{{$publicArticle->isSuper() ? 'col-12' : 'col-4'}}">
                        <img
                            style="max-height: 250px; width: 100%;"
                            class="card-img-top"
                            src="https://st.depositphotos.com/1032577/3572/i/950/depositphotos_35727883-stock-photo-black-background.jpg"
                            alt="Card image cap">
                    </div>
                    @if ($publicArticle->isSuper() === false)
                        <div class="col-4">
                            <div class="row">
                                <h1>{{$publicArticle->getName()}}</h1>
                            </div>
                            <div class="row mt-3">
                                <h1>{{$publicArticle->getPostedAt()}}</h1>
                            </div>
                        </div>
                    @endif
                </div>
                @if ($publicArticle->isSuper() === true)
                    <div class="row mt-3">
                        <div class="col">
                            <h1>{{$publicArticle->getName()}}</h1>
                        </div>
                        <div class="col text-right">
                            <h1>{{$publicArticle->getPostedAt()}}</h1>
                        </div>
                    </div>
                @endif
                <div class="row">
                    {{--                    <a class="col" href="{{$imagePicture??''}}">--}}
                    {{--                        {{$imagePicture??''}}--}}
                    {{--                    </a>--}}
                    <div class="col-12 mt-3">
                        <h5>
                            {{--                        <output>dawd</output>--}}
                            {{--                        Описание--}}
                            {{--                            {!!$articleGuest->trix('content')!!}--}}
                            @trix($publicArticle, 'content', [ 'hideToolbar'=>'true'])
                            {{--                        @trix(\App\Product::class, 'content')--}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
