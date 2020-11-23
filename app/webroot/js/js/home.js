var crnLoaction = "";
var crnCity = "";
var crnState = "";
var pageURL = "/istrat/ecom/api/";
var apiPath = "";
if ($(location).attr("hostname").indexOf(".com") != -1) {
    pageURL = "https://" + $(location).attr("hostname") + "/istrat/ecom/api/";
}
var homePage = function () {
    this.loaderDiv =
        "<div style='width: 100%;height: 100%; background: rgba(255,255,255,.4); position: fixed; z-index: 10000; top:0;' id='loader1'> <svg style='margin: 0 auto; position: absolute; left: 0; right: 0; top: 48%;' width='72px' height='72px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' preserveAspectRatio='xMidYMid' class='uil-ring-alt'><rect x='0' y='0' width='100' height='100' fill='none' class='bk'></rect><circle cx='50' cy='50' r='40' stroke='#e7aa3b' fill='none' stroke-width='10' stroke-linecap='round'></circle><circle cx='50' cy='50' r='40' stroke='#fff' fill='none' stroke-width='6' stroke-linecap='round'><animate attributeName='stroke-dashoffset' dur='2s' repeatCount='indefinite' from='0' to='502'></animate><animate attributeName='stroke-dasharray' dur='2s' repeatCount='indefinite' values='150.6 100.4;1 250;150.6 100.4'></animate></circle></svg> </div>";
    this.api = function (apiData) {
        $.ajax({
            type: "POST",
            url: apiData.path,
            data: apiData.data,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: eval("this." + apiData.callBack),
            error: function (er) {
                console.log(er);
            },
        });
    };
};
homePage.prototype.healthPack = function (responce) {
    $("#loader1").remove();
    for (var i = 0; i < responce.length; i++) {
        $("#healthPack").append(
            '<div> <a href="' +
                responce[i].TestURL +
                '"> <div class="healthpkgs-box1"> <h3 class="hpkghead">' +
                responce[i].TestName +
                '</h3> <span class="pkgsubtxt">' +
                responce[i].TestComponents.substring(0, 120) +
                '...</span> <div class="pkgprice"><span>&#8377;' +
                responce[i].mrp +
                "</span> &#8377;" +
                responce[i].price +
                '</div> <span class="arrowlink"></span> </div> </a> </div>'
        );
    }
    slidFN();
    $("#hpDiv").css({ height: "auto" }).animate({ opacity: 1 }, 1000);
};
homePage.prototype.BlogData = function (responce) {
    $("#loader1").remove();
    var blogDiv = "";
    for (var i = 0; i < responce.posts.length; i++) {
        blogDiv = '<div> <a href="' + responce.posts[i].url + '" target="_blank"> <div class="blogbox-inner"> <div class="blogimg">';
        if (responce.posts[i].hasOwnProperty("thumbnail_images")) {
            if (responce.posts[i].thumbnail_images != "") {
                blogDiv += '<img src="' + responce.posts[i].thumbnail_images.full.url + '" class="scale" alt="">';
            } else {
                blogDiv += '" class="scale" alt="">';
            }
        } else {
            blogDiv += '<img src="" class="scale" alt="">';
        }
        blogDiv +=
            '</div> <div class="blogtxtwrap"> <div class="blogtxt-heading">' +
            responce.posts[i].title +
            '</div> <div class="blogsubtxt">' +
            responce.posts[i].excerpt.substring(0, 100) +
            '...</div> <div class="byteam">By ' +
            responce.posts[i].author.nickname +
            '</div> <div class="eye"><i class="far fa-eye"></i> ' +
            responce.posts[i].post_views_count +
            "</div> </div> </div> </a> </div>";
        $("#healthBlog").append(blogDiv);
    }
    slidFN2();
    $("#blogDiv").css({ height: "auto" }).animate({ opacity: 1 }, 1000);
};

homePage.prototype.homeBanner = function (responce) {
    $("#loader1").remove();
    console.log(responce);
    for (var i = 0; i < responce.BannerData.length; i++) {
        $("#banner").append(
            '<div> <div class="bannerimg"> <a  href="' +
                responce.BannerData[i].BannerURL +
                '"><img src="' +
                responce.BannerData[i].BannerImgs +
                '" class="scale" alt="" /> </a><div class="bannertxt-wrap"> <h3> </h3> <div class="bannersubtxt"> </div> </div> </div> </div>'
        );
    }
};
function slidFN() {
    $(".healthpkgs-all").slick({
        dots: true,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true, centerMode: true, variableWidth: true } },
            { breakpoint: 767, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true, centerMode: true, variableWidth: true } },
            { breakpoint: 490, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true, centerMode: true, variableWidth: true } },
        ],
    });
}
function slidFN2() {
    var $status = $(".pagingInfo");
    var $slickElement = $(".blog-container");
    $slickElement.on("init reInit afterChange", function (event, slick, currentSlide) {
        var i = (currentSlide ? currentSlide : 0) + 1;
        $status.text(i + "/" + slick.slideCount);
    });
    $slickElement.slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: false, centerMode: true, variableWidth: true } },
            { breakpoint: 767, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: false, centerMode: true, variableWidth: true } },
            { breakpoint: 490, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: false, centerMode: true, variableWidth: true } },
        ],
    });
}
function slidFN3() {
    var $status = $(".pagingInfo");
    var $slickElement = $(".blog-container2");
    $slickElement.on("init reInit afterChange", function (event, slick, currentSlide) {
        var i = (currentSlide ? currentSlide : 0) + 1;
        $status.text(i + "/" + slick.slideCount);
    });
    $slickElement.slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: false, centerMode: true, variableWidth: true } },
            { breakpoint: 767, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: false, centerMode: true, variableWidth: true } },
            { breakpoint: 490, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: false, centerMode: true, variableWidth: true } },
        ],
    });
}
$(document).ready(function () {
    $(".offers-announcement").slick({
        dots: true,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true, centerMode: true, variableWidth: true } },
            { breakpoint: 767, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true, centerMode: true, variableWidth: true } },
            { breakpoint: 490, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true, centerMode: true, variableWidth: true } },
        ],
    });
    $(".homebanner").slick({
        dots: true,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 1, slidesToScroll: 1, infinite: true } },
            { breakpoint: 600, settings: { slidesToShow: 1, slidesToScroll: 1 } },
            { breakpoint: 490, settings: { slidesToShow: 1, slidesToScroll: 1 } },
        ],
    });

    $('.healthpackagesall').slick({
        dots: false,
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToScroll: 1,
        infinite: true,
        prevArrow: false,
        nextArrow: false,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                    autoplay: true
                }
              },
             {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

});