@extends('layouts/default')

{{-- Page title --}}
@section('title')
Blog
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/blog.css') }}">
<!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Blog</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 mt-6">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <img src="/assets/img/photo/blog-page.png" class="img-fluid p-4" alt="">
                    <hr>
                    <img src="/assets/img/photo/blog-page-list.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container Section Strat -->
 <div class="container blogpage">
    <h2 class="my-3">Blog</h2>
    <!-- my style -->
    @forelse ($blogs as $blog)
    <br>
    <div class="thumbnail m-0 p-0" style="border-style: hidden;">
        <div class="row ">
            <div class="col-lg-6 col-md-6 col-12 my-2">
               <img src="/assets/img/photo/blog-page-list.png" class="img-fluid" alt="Image" style="height: 100%;width: 100%;">
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-2 text-center align-middle" style="vertical-align: middle;align-items: center;text-align: center;">
                <br>
                <p class="text-left" style="font-size: 20px;text-align: left;opacity: 0.8;"><b>
                    <?php 
                        echo date_format($blog->created_at,"M d, Y");
                    ?>
                   </b></p>
                <br>
                <loren class="text-center p-1" style="text-align: left;font-weight: bold;font-size: 33px;">{{$blog->title}}</loren>
                <p style="margin-top: 25px; font-size: 20px; text-align: left;">
                    <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i> by&nbsp;<a
                                href="#">{{$blog->author->first_name . ' ' . $blog->author->last_name}}</a>
                </p>
            </div>
        </div>
    </div>
    <br>
    <hr>
    @empty
            <h3>No Posts Exists!</h3>
            @endforelse

    <div class="row d-none">
        <div class="col-md-8 col-lg-8 col-12 my-2">
            @forelse ($blogs as $blog)
            <!-- BEGIN FEATURED POST -->
            <div class="thumbnail">
                @if($blog->image)
                <div class="row bg-primary">
                    <img src="{{ URL::to('/uploads/blog/'.$blog->image)  }}" class="img-fluid" alt="Image">
                </div>
                @endif
                <div class="p-1 relative-left">
                    <h3 class="text-primary"><a href="{{ URL::to('blogitem/'.$blog->slug) }}">{{$blog->title}}</a>
                    </h3>
                    <p>
                        {!! $blog->content !!}
                    </p>
                    <p>
                        <strong>Tags: </strong>
                        @forelse($blog->tags as $tag)
                        <a href="{{ URL::to('blog/'.mb_strtolower($tag).'/tag') }}">{{ $tag }}</a>,
                        @empty
                        No Tags
                        @endforelse
                    </p>
                    <p class="additional-post-wrap">
                        <span class="additional-post">
                            <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i> by&nbsp;<a
                                href="#">{{$blog->author->first_name . ' ' . $blog->author->last_name}}</a>
                        </span>
                        <span class="additional-post">
                            <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i><a href="#"> {{$blog->created_at->diffForHumans()}}</a>
                        </span>
                        <span class="additional-post">
                            <i class="livicon" data-name="comment" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i><a href="#"> {{$blog->comments->count()}} comments</a>
                        </span>
                    </p>
                    <hr>
                    <p class="text-right">
                        <a href="{{ URL::to('blogitem/'.$blog->slug) }}" class="btn btn-primary text-white">Read
                            more</a>
                    </p>
                </div>
                <!-- /.featured-text -->
            </div>
            <!-- /.featured-post-wide -->
            <!-- END FEATURED POST -->
            @empty
            <h3>No Posts Exists!</h3>
            @endforelse
            <ul class="pager">
                {!! $blogs->render() !!}
            </ul>
        </div>
        <!-- /.col-md-8 -->
        <div class="ml-auto col-md-4 col-lg-4 col-12 d-none">
            <!-- END POPULAR POST -->
            <!-- Tabbable-Panel Start -->
            <h3>Tab Widget</h3>
            <div class="tabbable-panel">
                <!-- Tabbablw-line Start -->
                <div class="tabbable-line">
                    <!-- Nav Nav-tabs Start -->
                    <ul class="nav nav-tabs ">
                        <li class=" nav-item">
                            <a href="#tab_default_1" data-toggle="tab" class="nav-link active">
                                Popular Posts </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab_default_2" data-toggle="tab" class="nav-link">
                                Recent Posts </a>
                        </li>
                    </ul>
                    <hr class="horizontalline">
                    <!-- //Nav Nav-tabs End -->
                    <!-- Tab-content Start -->
                    <div class="tab-content">
                        <div class="tab-pane  fade show active" id="tab_default_1">
                            <div class="media">
                                <div class="media-left tab col-sm-6 col-md-12 col-12">
                                    <a href="#">
                                        <img class="media-object img-fluid" src="{{ asset('images/img_3.jpg') }}"
                                            alt="image">
                                    </a>
                                </div>
                            </div>
                            <h4 class="text-primary">Jelly-o sesame snaps</h4>
                            <p>
                                Extraordinary claims require extraordinary evidence globular star cluster great
                                turbulent clouds dispassionate extraterrestrial observer hearts of the stars.
                                Jean-François Champollion Euclid the sky.
                            </p>
                            <div class="text-right primary mb-1"><a href="#">Read more</a>
                            </div>
                            <div class="media">
                                <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                    <a href="#">
                                        <img class="media-object img-fluid" src="{{ asset('images/img_5.jpg') }}"
                                            alt="image">
                                    </a>
                                </div>
                            </div>
                            <h4 class="text-primary">Fishing cayenne bisque cayenne</h4>
                            <p>
                                The Love Boat soon will be making another run. The Love Boat promises something for
                                everyone. On the most sensational inspirational celebrational Muppetational. This is
                                what we call the Muppet Show.
                            </p>
                            <div class="text-right primary"><a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_default_2">
                            <div class="media">
                                <div class="media-left media-middle tab col-sm-12 col-12">
                                    <a href="#">
                                        <img class="media-object img-fluid my-2" src="{{ asset('images/img_5.jpg') }}"
                                            alt="image">
                                    </a>
                                </div>
                            </div>
                            <h4 class="text-primary">Come along, Pond. Allons-y</h4>
                            <p>
                                Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne
                                lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De
                                apocalypsi gorger omero undead survivor dictum mauris.
                            </p>
                            <div class="text-right primary mb-1"><a href="#">Read more</a>
                            </div>
                            <div class="media">
                                <div class="media-left tab col-sm-6 col-md-12 col-12">
                                    <a href="#">
                                        <img class="media-object img-fluid my-2" src="{{ asset('images/img_3.jpg') }}"
                                            alt="image">
                                    </a>
                                </div>
                            </div>
                            <h4 class="text-primary">Jelly-o sesame snaps</h4>
                            <p>
                                Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi
                                dentevil vultus comedat cerebella viventium. Qui animated corpse, cricket bat max
                                brucks terribilem incessu zomby.
                            </p>
                            <div class="text-right primary"><a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- //Tab-content End -->
                </div>
                <!-- //Tabbablw-line End -->
            </div>
            <!-- Tabbable_panel End -->
            <div class="recent p-3 border radius mb-3">
                <h3 class="small-heading text-center">Recent Comments</h3>

                <div class="media">
                    <a class="float-left" href="#">
                        <img src="{{ asset('images/authors/avatar.jpg') }}" class="rounded-circle img-fluid float-left"
                            alt="riot">
                    </a>
                    <div class="media-body ml-3">
                        <h4 class="media-heading primary">
                            <a href="#">Elizabeth Owens at Duis autem vel eum iriure dolor in hendrerit in</a>
                        </h4>
                        <p class="date">
                            <small class="text-danger">2hours ago</small>
                        </p>
                        <p class="small">
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                            sollicitudin commodo
                        </p>
                    </div>
                </div>
                <hr>
                <div class="media">
                    <a class="float-left" href="#">
                        <img src="{{ asset('images/authors/avatar1.jpg') }}" class="rounded-circle img-fluid float-left"
                            alt="riot">
                    </a>
                    <div class="media-body ml-3">
                        <h4 class="media-heading primary">
                            <a href="#">Harold Chavez at Duis autem vel eum iriure dolor in hendrerit in</a>
                        </h4>
                        <p class="date">
                            <small class="text-danger">5hours ago</small>
                        </p>
                        <p class="small">
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                            sollicitudin commodo
                        </p>
                    </div>
                </div>
                <hr>
                <div class="media">
                    <a class="float-left" href="#">
                        <img src="{{ asset('images/authors/avatar5.jpg') }}" class="rounded-circle img-fluid float-left"
                            alt="riot">
                    </a>
                    <div class="media-body ml-3">
                        <h4 class="media-heading primary">
                            <a href="#">Mihaela Cihac at Duis autem vel eum iriure dolor in hendrerit in</a>
                        </h4>
                        <p class="date">
                            <small class="text-danger">10hours ago</small>
                        </p>
                        <p class="small">
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                            sollicitudin commodo
                        </p>
                    </div>
                </div>
            </div>
            <div class="thumbnail">
                <h3>Tags</h3>
                <div class="primary text-center">
                    @forelse($tags as $tag)
                    <a href="{{ URL::to('blog/'.$tag.'/tag') }}">{{ $tag }}</a>,
                    @empty
                    No Tags
                    @endforelse
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div>
</div> 

@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
