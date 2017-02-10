<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenue sur myProject</title>

        <!-- Materialize -->
        <link href="{{ asset('assets/plugins/materialize/css/materialize.css') }}" rel="stylesheet" type="text/css">

        <!-- Font-Awesome -->
        <link href="{{ asset('assets/font/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">

        <!-- Owl Caroussel -->
        <link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/plugins/owl-carousel/owl.theme.css') }}" rel="stylesheet" type="text/css">

        <style>
            header nav ul li a{
                color: #424242;
            }
            .global-container{
                background-image: url({{   asset('assets/img/home.jpg') }});
                background-size: 100% auto;
                min-height: 600px;
            }
            .owl-carousel h3,h4{
                color: #bbdefb;
                font-weight: 300;
            }
            .owl-carousel p{
                color: #f5f5f5;
            }
            .owl-theme .owl-controls .owl-page span {
                background: #f5f5f5;
            }
            .owl-theme .owl-controls .owl-page.active span,
            .owl-theme .owl-controls.clickable .owl-page:hover span {
                filter: Alpha(Opacity=100);
                opacity: 1;
                background: #2196f3;
            }
            .owl-theme .owl-controls .owl-page.active span{
                background: #2196f3;
            }
            #portfolio a{
                overflow: hidden;
                display: block;
            }
            #portfolio .col{
                padding: 4px 0;
            }
        </style>
    </head>
    <body>

        <!-- Header -->
        <header>
            <nav class="white grey-text text-darken-3">
                <div class="nav-wrapper container">
                    <a href="#" class="brand-logo">
                        <span class="grey-text">my</span><span class="light-blue-text text-darken-4">Project</span>
                    </a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="" class="connector">Connexion</a></li>
                        <li><a href="#inscriptionModal" class="modal-trigger">Inscription</a></li>
                    </ul>
                </div>

            </nav>
        </header>

        <!-- Inscription Form -->
        <div id="inscriptionModal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <form action="{{ url('auth/register') }}" method="post" class="col s12" id="inscriptionForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s12">
								<div class="form-group">
									<input name="type" type="radio" id="formInscriptionType1" value="student" checked />
									<label for="formInscriptionType1">Etudiant</label>
									<input name="type" type="radio" id="formInscriptionType2" value="mentor" />
									<label for="formInscriptionType2">Encadrant</label>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
								<div class="form-group">
									<input id="first_name" type="text" class="validate" name="first_name" value="{{ old('first_name') }}" required>
									<label for="first_name">Prénom</label>
								</div>
                            </div>
                            <div class="input-field col m6 s12">
								<div class="form-group">
									<input id="last_name" type="text" class="validate" name="last_name" value="{{ old('last_name') }}" required>
									<label for="last_name">Nom</label>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <div class="form-group">
                                    <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="input-field col m6 s12">
                                <div class="form-group">
                                    <input id="tel" type="tel" class="validate" name="phone" value="{{ old('phone') }}" >
                                    <label for="tel">Téléphone</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-panel teal lighten-4">
                            <span class="teal-text text-darken-3">Votre email sera utilisé comme indentifiant</span>
                        </div>
                        <div id="forStudents">
                            <div class="row">
                                <div class="input-field col m6 s12">
                                    <div class="form-group">
                                        <input id="affiliation" type="text" class="validate" name="affiliation" value="{{ old('affiliation') }}" placeholder="Lieu de Doctorat, Entreprise de PFE...">
                                        <label for="affiliation">Affiliation</label>
                                    </div>
                                </div>
                                <div class="input-field col m6 s12">
                                    <div class="form-group">
                                        <input id="grade" type="text" class="validate" name="grade" value="{{ old('grade') }}" placeholder="Niveau actuel d'études">
                                        <label for="grade">Niveau</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="form-group">
                                        <input id="field" type="text" class="validate" name="field" value="{{ old('field') }}">
                                        <label for="field">Filière</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" class="validate" name="project_id" value="{{ old('project_id') }}">
                            </div>
                        </div>
                        <div id="forMentors" style="display:none;">
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="form-group">
                                        <input id="field" type="text" class="validate" name="domain" value="{{ old('domain') }}">
                                        <label for="field">Domaine d'enseignement</label>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="input-field col m6 s12">
								<div class="form-group">
									<input id="password" type="password" class="validate" name="password" required>
									<label for="password">Mot de passe</label>
								</div>
							</div>
							
                            <div class="input-field col m6 s12">
								<div class="form-group">
									<input id="password_confirmation" type="password" class="validate" name="password_confirmation" required>
									<label for="password_confirmation">Vérification du mot de passe</label>
								</div>
							</div>
                        </div>
						
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn green waves-effect waves-light" value="S'inscrire" form="inscriptionForm">
                <input type="button" class="modal-action modal-close waves-effect waves-light btn-flat " value="Annuler">
            </div>
        </div>

        <!-- Errors -->
        @if (count($errors) > 0)
            <div id="formErrors" class="modal bottom-sheet deep-orange lighten-4">
                <div class="modal-content">
                    <h5>Erreurs</h5>
                    <p>
                        <ul class="" style="">
                            @foreach ($errors->all() as $error)
                                <li class="" >{{ $error }}</li>
                            @endforeach
                        </ul>
                    </p>
                </div>
                <div class="modal-footer deep-orange lighten-4">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Compris</a>
                </div>
            </div>
        @endif

        <!-- Content -->
        <section class="global-container">
        <div class="container" style="padding-top: 40px;margin-bottom: -20px;">
            <div class="row">
                <div class="col m7 s12 push-s12">
                    <div class="row">
                        <div class="col m12 s12">
                            <div class="owl-carousel">
                                <div>
                                    <h3>Bienvenue sur myProject</h3>
                                    <p>
                                        myProject est une plateforme de suivi et d’encadrement des PFE et Doctorat et autres projets.
                                        A travers des comptes étudiants et professeurs (encadreurs),
                                        la plateforme permet de gérer les PFE et Doctorat en particulier,
                                        et une éventuelle extension aux projets en général.
                                    </p>
                                </div>
                                <div>
                                    <h4>Contact permanent Etudiant/Professeur</h4>
                                    <p>
                                        les professeurs pourront suivre les travaux sur les projets qu’ils encadrent,
                                        télécharger les documents relatifs, donner des taches, fixer des objectifs,
                                        programmer des rendez-vous…etc. Et les opérations réciproques pour les étudiants.
                                    </p>
                                </div>
                                <div>
                                    <h4>Encadrement avancé</h4>
                                    <p>
                                        Cette perception de la gestion de projet s’avère très utile. Notamment dans le cas où,
                                        par exemple, un étudiant va faire le PFE dans une autre ville, et ce retrouve ainsi
                                        loin de l’encadreur qui lui a été assigné par son école.
                                        La plateforme permet ainsi à l’encadreur de toujours garder un œil sur le projet et son évolution.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col s12 m5 pull-s12">
                    <div class="card-panel">
                        <form action="{{ url('auth/login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="formConnexionEmail" type="email" name="email" class="validate">
                                    <label for="formConnexionEmail">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="formConnexionPassword" type="password" name="password" class="validate">
                                    <label for="formConnexionPassword">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m6">
                                    <input type="checkbox" id="formConnexionStay" checked="checked" name="remember" />
                                    <label for="formConnexionStay">Rester connecté</label>
                                </div>
                                <div class="col m6" style="text-align: right;">
                                    <input type="submit" class="btn waves-effect waves-light" value="Connexion">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        </section>
        <footer class="page-footer grey lighten-4">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h4>
                            <span class="grey-text">my</span><span class="light-blue-text text-darken-4">Project</span>
                        </h4>
                        <p class="grey-text text-darken-1">
                            Six étudiants de l'école Mohammadia d'ingénieurs motivés, dynamiques et enthousiastes.
                            L'idée de ce projet vient du fait que les doctorants à l'EMI à titre d'exemple trouvent
                            des difficultés à communiquer avec leurs encadrants surtout ceux qui habitent loin de Rabat,
                            c'est justement ce qui nous a poussé à travailler sur un tel projet.
                        </p>
                        <div class="row" id="portfolio">
                            <div class="col m2 s4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Joel TANKAM (Chef de groupe)">
                                <a href="mailto:">
                                    <img src="{{ asset('assets/img/us/3.jpg') }}" width="100%">
                                </a>
                            </div>
                            <div class="col m2 s4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Fatima JAMAL-TABIT">
                                <a href="mailto:">
                                    <img src="{{ asset('assets/img/us/1.jpg') }}" width="100%">
                                </a>
                            </div>
                            <div class="col m2 s4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ghizlane KAMAL">
                                <a href="mailto:">
                                    <img src="{{ asset('assets/img/us/2.jpg') }}" width="100%">
                                </a>
                            </div>
                            <div class="col m2 s4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lancine KEITA">
                                <a href="mailto:">
                                    <img src="{{ asset('assets/img/us/4.jpg') }}" width="100%">
                                </a>
                            </div>
                            <div class="col m2 s4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Abdourahmane KOYRANGA">
                                <a href="mailto:">
                                    <img src="{{ asset('assets/img/us/5.jpg') }}" width="100%">
                                </a>
                            </div>
                            <div class="col m2 s4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Abir NAJID">
                                <a href="mailto:">
                                    <img src="{{ asset('assets/img/us/6.png') }}" width="100%">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h6 class="grey-text text-darken-1">Liens</h6>
                        <ul>
                            <li>
                                <a class="grey-text text-darken-1" href="#!">
                                    <i class="fa fa-facebook-square"></i>&nbsp;Facebook
                                </a>
                            </li>
                            <li>
                                <a class="grey-text text-darken-1" href="#!">
                                    <i class="fa fa-twitter-square"></i>&nbsp;Twitter
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container grey-text text-darken-1">
                    © {{ Carbon\Carbon::now()->formatLocalized("%Y") }} myProject
                </div>
            </div>
        </footer>
    </body>

    <!-- jQuery -->
    <script  src="{{ asset('assets/plugins/jquery/jquery-2.2.0.js') }}"></script>

    <!-- Materialize -->
    <script  src="{{ asset('assets/plugins/materialize/js/materialize.js') }}"></script>

    <!-- Owl-Caroussel -->
    <script  src="{{ asset('assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>


    <script>
        $(".owl-carousel").owlCarousel({
            'items' : 1
        });
        $('.modal-trigger').leanModal();

        function homeHeight(){
            var homeHeight = $(window).height() - $("header").height();
            $('.global-container').css('min-height', homeHeight+'px');
        }

        $(window).resize(function(){
            homeHeight();
        });
        $('.connector').click(function(){
            $('#formConnexionEmail').focus();
            return false;
        });
        $('#inscriptionForm [name=type]').on('change', function(){
            var $type= $(this);
            if($type.attr('value')=="student"){
                $('#forStudents').slideDown();
                $('#forMentors').slideUp();
            }else{
                $('#forStudents').slideUp();
                $('#forMentors').slideDown();
            }
        });
        $(document).ready(function(){
            $('#portfolio a').height($('#portfolio a').width() * 0.7);
            $('.tooltipped').tooltip({delay: 50});
            homeHeight();
            @if (count($errors) > 0)
                $('#formErrors').openModal();
            @endif
            @if(isset($registration))
                $('#inscriptionModal').openModal();
            @endif
        });
    </script>

</html>
