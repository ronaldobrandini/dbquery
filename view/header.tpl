<nav class="navbar-inverse" role="navigation">
    <div class="toolbar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">DB Query</a>
        </div>
        <div class="navigation navbar-collapse collapse toolbar-tools">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Aparelhos não Alocados">
                        <i class="fa fa-mobile"></i>
                        <sup><span id="qntMobile" class="badge">0</span></sup>
                    </a>
                    <ul class="dropdown-menu" id="mobile">    
                        <li class="dropdown-header">Aparelhos não alocados</li>
                    </ul>
                </li>
                <!--<li class="dropdown">
                    <a href="javascript: void(0);" data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true">
                        <i class="fa fa-envelope-o"></i>
                        <sup><span class="badge">12</span></sup>
                    </a>
                    <ul class="dropdown-menu dropdown-light dropdown-messages">
                        <li>
                            <span class="dropdown-header"> You have 9 messages</span>
                        </li>
                        <li>
                            <div class="drop-down-wrapper ps-container">
                                <ul>
                                    <li class="unread">
                                        <a href="javascript:;" class="unread">
                                            <div class="clearfix">
                                                <div class="thread-image">
                                                    <img src="http://www.placehold.it/50x50/EFEFEF/AAAAAA?text=Sem+Imagem" alt="">
                                                </div>
                                                <div class="thread-content">
                                                    <span class="author">Nicole Bell</span>
                                                    <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                    <span class="time"> Just Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="unread">
                                            <div class="clearfix">
                                                <div class="thread-image">
                                                    <img src="http://www.placehold.it/50x50/EFEFEF/AAAAAA?text=Sem+Imagem" alt="">
                                                </div>
                                                <div class="thread-content">
                                                    <span class="author">Steven Thompson</span>
                                                    <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                    <span class="time">8 hrs</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="clearfix">
                                                <div class="thread-image">
                                                    <img src="http://www.placehold.it/50x50/EFEFEF/AAAAAA?text=Sem+Imagem" alt="">
                                                </div>
                                                <div class="thread-content">
                                                    <span class="author">Kenneth Ross</span>
                                                    <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                    <span class="time">14 hrs</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="text-center">
                            <a href="pages_messages.html">
                                See All
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!--<li class="dropdown">
                    <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-camera"></i>
                        <sup><span class="badge">42</span></sup>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>-->
                <li>
                    <a href="?controller=perfil">Perfis</a>
                </li>
                <li>
                    <a href="?controller=aparelho">Aparelho</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gears"></i>
                    </a>
                    <ul class="dropdown-menu">
                        
                        <li>
                            <a href="?logout=true">
                                <i class="fa fa-times"></i>
                                Sair
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>