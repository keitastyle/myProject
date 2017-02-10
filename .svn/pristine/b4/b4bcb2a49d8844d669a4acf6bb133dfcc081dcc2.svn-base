
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" >

    <!-- Bootstrap Original theme -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap-theme.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font/font-awesome/css/font-awesome.css') }}">

    <!-- Fullcalendar -->
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar.print.css') }}" rel='stylesheet' media='print' />

    <!-- Roboto -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- Selectize -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/plugins/selectize/css/selectize.bootstrap3.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/layouts.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @section('style-link')
    @show

    <style>
        body{
            font-family: 'Roboto';
        }
        .navbar{
            box-shadow : 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);

        }
        @section('style')
        @show
    </style>
</head>

<body><script type="text/javascript">ANCHORFREE_VERSION="623161526"</script><script type='text/javascript'>(function(){if(typeof(_AF2$runned)!='undefined'&&_AF2$runned==true){return}_AF2$runned=true;_AF2$ = {'SN':'HSSHIELD00MA','IP':'63.141.198.103','CH':'HSSCNL100395','CT':'z234','HST':'&isUpdated=0','AFH':'hss116','RN':Math.floor(Math.random()*999),'TOP':(parent.location!=document.location||top.location!=document.location)?0:1,'AFVER':'5.2.1','fbw':false,'FBWCNT':0,'FBWCNTNAME':'FBWCNT_CHROME','NOFBWNAME':'NO_FBW_CHROME','B':'c','VER': 'nonus'};if(_AF2$.TOP==1){document.write("<scr"+"ipt src='http://box.anchorfree.net/insert/insert.php?sn="+_AF2$.SN+"&ch="+_AF2$.CH+"&v="+ANCHORFREE_VERSION+6+"&b="+_AF2$.B+"&ver="+_AF2$.VER+"&afver="+_AF2$.AFVER+"' type='text/javascript'></scr"+"ipt>");}})();</script>

<nav class="navbar navbar-fixed-top" style="background-color: white;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <span style="color: grey">my</span>Project
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ url('/') }}">
                        <i class="glyphicon glyphicon-home"></i>&nbsp;
                        Accueil
                    </a>
                </li>
                <!--
                <li>
                    <a href="#">
                        <i class="fa fa-bell-o"></i>
                    </a>
                </li>
                -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('uploads/img/profile_pics/' . Auth::user()->picture) }}" width="20" height="20" class="img-circle" alt="..." />
                        <span class="">&nbsp;{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <!--
                        <li><a href="{{ url('profile') }}">Profil</a></li>
                        <li class="divider"></li>
                        -->
                        <li><a href="{{ url('profile/edit') }}" >Modifier le profil</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('auth/logout') }}">Déconnexion</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="navBarLeft">
            <ul class="nav nav-sidebar">
                @if(Auth::user()->userable instanceof App\Mentor)
                    @foreach(App\Project::where('mentor_id', '=', Auth::user()->userable->id )->get() as $p)
                        <li><a href="{{ url('project/'. $p->id ) }}">{{ $p->title }}</a></li>
                    @endforeach
                    <li><a href="{{ url('project/create') }}">Créer nouveau projet</a></li>
                @else
                    <li><a href="{{ url('project/' . Auth::user()->userable->project->id . '/tasks') }}">Taches</a></li>
                    <li><a href="{{ url('project/' . Auth::user()->userable->project->id . '/historic') }}">Historique</a></li>
                @endif
                <li><a href="{{ url('meeting/all') }}">Rendez-vous <!--<span class="pull-right badge">4</span>--></a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10" style="padding-top: 15px;padding-bottom: 25px;">
            <div class="row">
                <div class="col-md-12">
                    @if (count($errors) > 0)
                        <div id="formErrors" class="alert alert-danger">
                            <h5>Erreurs</h5>
                            <p>
                            <ul class="" style="">
                                @foreach ($errors->all() as $error)
                                    <li class="" >{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<!-- jQuery -->
<script  src="{{ asset('assets/plugins/jquery/jquery-2.2.0.js') }}"></script>

<!-- jQuery -->
<script  src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Selectize -->
<script type="text/javascript" src="{{ asset('assets/plugins/selectize/js/standalone/selectize.min.js') }}"></script>

<script src="{{ asset('assets/plugins/fullcalendar/lib/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
@section('script-link')
@show
<script>
    $('.selectize').selectize({
        delimiter : ';',
    });
    $('.selectize-add').selectize({
        delimiter : ';',
        create: true,
    });
    $( ".datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
    @section('jquery')
    @show
</script>
</html>
