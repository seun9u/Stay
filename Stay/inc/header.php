<?php require_once("session.php");?>

<div id="header_wrapper">
        <header>
            <ul class="util_nav">
                <?php

                if (isset($_SESSION['member_id']) === false){
                ?>
                <li class="util_nav01">
                    <a href="sign_up.php"><span>회원가입</span></a>
                </li>
                <li class="util_nav02">
                    <a href="#"><span>고객센터</span></a>
                </li>
                <li class="util_nav03">
                    <a href="login.php"><span>로그인</span></a>
                </li>
                <?php
                }else{
                ?>
                <li class="util_nav01">
                    <a href="my-page_order.php"><span>마이페이지</span></a>
                </li>
                <li class="util_nav02">
                    <a href="#"><span>고객센터</span></a>
                </li>
                <li class="util_nav03">
                    <a href="logout.php"><span>로그아웃</span></a>
                </li>
                <?php
                }
                ?>


                
            </ul>
            <div class="main_nav">
                <a href="index.php" class="logo_link_index">
                    <div class="logo_wrapper">
                        <!-- <img class="logo" src="" alt=""> -->
                        <span class="logo">STAY</span>
                    </div>
                </a>

                <!--검색창-->
                <div class="search_wrapper">
                    <fieldset class="field-container">
						<form	method="POST">
							<input type="text" placeholder="Search..." class="field" name="search_main"/>
							<div class="icons-container">
								<div class="icon-search"></div>
						</form>
                    </fieldset>
                </div>
                <div class="like_nav">
                    <i class="far fa-heart fa-1x"></i>
                    <span class="like_nav_title">찜한 상품</span>
                </div>
                <a href="cart.php">
                    <div class="cart_nav">
                    <i class="fas fa-shopping-bag fa-1x"></i>
                    <span class="cart_nav_title">장바구니</span>
                </div>
                </a>
                <a href="my-page_member_pwd.php">
                    <div class="my_page_nav">
                    <i class="far fa-user fa-1x"></i>
                    <span class="my_page_nav_title">마이페이지</span>
                </div>
                </a>
                
<!--                <div class="hot_issue_wrapper">
                    <div class="hot_issue_under_line">
                        <div class="hot_issue">
                            <ul id="ticker_01" class="ticker">
                                <li><span class="rank">1. </span><a href="#">가을신상</a></li>
                                <li><span class="rank">2. </span><a href="#">아우터</a></li>
                                <li><span class="rank">3. </span><a href="#">가방신상</a></li>
                                <li><span class="rank">4. </span><a href="#">코트</a></li>
                            </ul>
                        </div>
                        <i class="fas fa-caret-down"></i>
                    </div> 
-->

                </div>
            </div>
            <div class="main_menu_wrapper">
<!--                 <a href="view_more_menu.php">
                   <div class="main_menu_detail">
                    <i class="fas fa-bars fa-2x"></i>
					</div>
                </a>
-->                
                <ul class="main_menu_bar">
                    <li class="main_menu01"><a href="event.php">이벤트</a></li>
                    <li class="main_menu02"><a href="">베스트</a></li>
                    <li class="main_menu03"><a href="">신상</a></li>
                    <li class="main_menu04"><a href="">여성구두</a></li>
                    <li class="main_menu05"><a href="">남성구두</a></li>
                    <li class="main_menu06"><a href="">운동화</a></li>
                    <li class="main_menu07"><a href="">샌들/슬리퍼</a></li>
                    <li class="main_menu08"><a href="">키즈화</a></li>
                    <li class="main_menu09"><a href="">가방</a></li>
                    <li class="main_menu10"><a href="">지갑</a></li>
                    <li class="main_menu11"><a href="">밸트</a></li>
                    <li class="main_menu12"><a href="">etc..</a></li>
                </ul>
<!--                <div class="delivery_today"><span>오늘출발</span></div> -->
            </div>
        </header>
    </div>