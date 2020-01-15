<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/libs.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
{{--    <link href="css/blog-post.css" rel="stylesheet">--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('post.index')}}">Blogs.Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::check())
                <li style="margin-left: 650px">
                    <form action="{{route('logout')}}" method="POST" >
                        {{csrf_field()}}
                        <input type="submit" value="LOGOUT" class="btn btn-lg">
                    </form>
                </li>
                    @else
                    <li>
                        <a href="{{route('login')}}">login</a> | <a href="{{route('register')}}">register</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$posts->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">{{$posts->user->name}}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span>{{$posts->created_at->diffForHumans()}}</p>

            <hr>

            <!-- Preview Image -->
            <img height="500" src="{{asset($posts->photo->path)}}" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead">{{$posts->body}}</p>

            <hr>

            <!-- Blog Comments -->
            <!-- Comments Form -->
            @if(\Illuminate\Support\Facades\Auth::check())
            <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST" action="{{route('comment.store')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="post_id" value="{{$posts->id}}">
                        <input type="hidden" name="author" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
                @else
                    <div class="alert-info text-center text-info"> to put comment or reply you should ligin first</div>
            @endif



            <hr>

            <!-- Posted Comments -->
            @if(session()->has('comment'))
                <div class="alert alert-info">
                    {{session('comment')}}
                </div>


            @endif

            <!-- Comment -->
            @foreach($posts->comment as $post)

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" height="60" src="{{asset($post->photo_author_comment)}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$post->author}}
                        <small>{{$post->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$post->comment}}



                    @foreach($post->reply as $reply)
                <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" height="60" src="{{asset($reply->photo_author_comment)}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$reply->author}}
                                <small>{{$reply->created_at->diffForHumans()}}</small>
                            </h4>
                            {{$reply->comment}}
                        </div>
                    </div>
                    @endforeach



                    @if(\Illuminate\Support\Facades\Auth::check())

                        <form role="form" method="POST" action="{{route('reply.store')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="comment_id" value="{{$post->id}}">
                            <input type="hidden" name="author" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="1" placeholder="type your replay for this comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit reply</button>
                        </form>
                     @endif
                    <!-- End Nested Comment -->
                </div>
            </div>
                <hr>
            @endforeach
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
{{--<script src="js/jquery.js"></script>--}}

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('js/libs.css')}}"></script>

</body>

</html>
