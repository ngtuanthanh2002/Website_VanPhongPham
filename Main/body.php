<style>
    <?php include 'CSS/body.css' ?>
</style>
<div class="section-banner-hotword--no-skin">
    <div class="event_shop">
        <div class="container-banner">
            <div class="full-home">
                <div class="main-banner">
                    <div class="slider">
                        <div class="btn-prev">
                            <div class="prev-icon">
                                <i class="fa-solid fa-angle-left"></i>
                            </div>
                        </div>
                        <div class="btn-next">
                            <div class="next-icon">
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                        <div class="slides">
                            <input type="radio" name="radio-btn" id="radio1">
                            <input type="radio" name="radio-btn" id="radio2">
                            <input type="radio" name="radio-btn" id="radio3">
                            <input type="radio" name="radio-btn" id="radio4">
                            <input type="radio" name="radio-btn" id="radio5">

                            <div class="slide first">
                                <img src="picture/1_6.jpg" alt="" class="size-img">
                            </div>
                            <div class="slide">
                                <img src="picture/1_2.jpg" alt="">
                            </div>
                            <div class="slide">
                                <img src="picture/1_3.jpg" alt="">
                            </div>
                            <div class="slide">
                                <img src="picture/1_4.png" alt="">
                            </div>
                            <div class="slide">
                                <img src="picture/1_5.jpg" alt="">
                            </div>
                            <div class="navigation-auto">
                                <div class="auto-btn-1"></div>
                                <div class="auto-btn-2"></div>
                                <div class="auto-btn-3"></div>
                                <div class="auto-btn-4"></div>
                                <div class="auto-btn-5"></div>
                            </div>

                        </div>

                        <div class="navigation-mannual">
                            <label for="radio1" class="mannual-btn"></label>
                            <label for="radio2" class="mannual-btn"></label>
                            <label for="radio3" class="mannual-btn"></label>
                            <label for="radio4" class="mannual-btn"></label>
                            <label for="radio5" class="mannual-btn"></label>
                        </div>


                    </div>
                    <script>
                        <?php include 'slide.js' ?>
                    </script>


                </div>
                <div class="extra-right-banner">
                    <img class="war2" src="picture/1_5.jpg" alt="..."/>
                    <img class="war3" src="picture/1_2.jpg" alt="..."/>
                    </a>
                </div>
            </div>
    </div>

        <?php
        include('danhmuc.php');
        // include('goiy.php');
        include('dssanpham.php');
        include('Footer.php');
        ?>
         </div>
     </div>
    </div>
</div>