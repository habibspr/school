<style type="text/css">
    .carousel{
        background: #2f4357;
        margin-top: auto;
    }
    .carousel .item img{
        margin: 0 auto; /* Align slide image horizontally center */
    }
</style>
<div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
        <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>   
    <!-- Wrapper for carousel items -->
    <div class="carousel-inner">
        <div class="active item">
            <img src="../images/slide (1).jpg" alt="First Slide">
            <div class="carousel-caption">
                
                <h3>Header 1 </h3>
                <p>Description 1</p>
                
            </div>
        </div>
        <div class="item">
            <img src="../images/slide (2).jpg" alt="Second Slide">
            <div class="carousel-caption">
                
                <h3>Header 2</h3>
                <p>Description 2</p>
                
            </div>
        </div>
        <div class="item">
            <img src="../images/slide (3).jpg" alt="Third Slide">
            <div class="carousel-caption">
                
                <h3>Header 3</h3>
                <p>Description 3</p>
                
            </div>
        </div>
        <div class="item">
            <img src="../images/slide (4).jpg" alt="Third Slide">
            <div class="carousel-caption">
                
                <h3>Header 4</h3>
                <p>Description 4</p>
                
            </div>
        </div>
        <div class="item">
            <img src="../images/slide (5).jpg" alt="Third Slide">
            <div class="carousel-caption">
                
                <h3>Header 5</h3>
                <p>Description 5</p>
                
            </div>
        </div>
    </div>
    <!-- Carousel controls -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <!--<span class="glyphicon glyphicon-chevron-left"></span>-->
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <!--<span class="glyphicon glyphicon-chevron-right"></span>-->
    </a>
</div>
