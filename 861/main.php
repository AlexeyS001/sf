<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>PHP практика</title>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="evoulve_circle">
    <canvas id="glslCanvas" data-fragment="
#ifdef GL_ES
precision lowp float;
#endif

#define TAU 6.28318530718

uniform vec2 u_resolution;
uniform vec2 u_mouse;
uniform float u_time;

// EASE IN/OUT AROUND POINT //
float pointEase(float x, float t, float r, float a) {
    if (x<(t-r) || x >(t+r)) return 0.0;

    float n = 0.0;
    x = t-x;
    n = ((1.0 + cos((x * ((TAU/2.0) * (1.0/r))))) / 2.0) * a;
    return n;
}

void main() {
	vec2 st = gl_FragCoord.xy/u_resolution;
    float aspect = u_resolution.x / u_resolution.y;
    float distort = st.x / st.y;
    float t = u_time * 0.5;
    float r = 0.8;


    // move origins of circles //
    float dx1 = 0.5 + (sin(t + 3000.00) * sin(t * 0.33) * 0.5);
    float dy1 = 0.5 + (cos(t + 1000.00) * cos(t * 0.23) * 0.5);
    float dx2 = 0.5 + (sin(t + 5000.00) * sin(t * 0.44) * 0.5);
    float dy2 = 0.5 + (cos(t + 2000.00) * cos(t * 0.43) * 0.5);
    float dx3 = 0.5 + (sin(t + 8000.00) * sin(t * 0.55) * 0.5);
    float dy3 = 0.5 + (cos(t + 3000.00) * cos(t * 0.63) * 0.5);


    // get sinuous amplitude based on distance from origins //
    float x1 = pointEase(st.x, dx1, r, 1.0);
    float y1 = pointEase(st.y, dy1, r * aspect, 1.0);
    float a1 = x1 * y1;
    float x2 = pointEase(st.x, dx2, r, 1.0);
    float y2 = pointEase(st.y, dy2, r * aspect, 1.0);
    float a2 = x2 * y2;
    float x3 = pointEase(st.x, dx3, r, 1.0);
    float y3 = pointEase(st.y, dy3, r * aspect, 1.0);
    float a3 = x3 * y3;

    // colors //
    vec3 c1 = (1.0 - (a2 * a3)) * a1 * vec3(1.0,0.0,1.0);
    vec3 c2 = (1.0 - (a1 * a3)) * a2 * vec3(1.0,0.0,1.0);
    vec3 c3 = (1.0 - (a1 * a2)) * a3 * vec3(1.0,0.0,1.0);
    vec3 bg = vec3(0.1,0.0,0.0);

    vec3 color = (c1 + c2 - c3);
    vec3 mixed = (0.0 - color) * bg;
    color += bg;


	gl_FragColor = vec4(color,1.0);
}
"></canvas>
    <div class="overlay color"></div>
    <div class="overlay saturate"></div>
    <div class="overlay light"></div>
    <div class="overlay reflect"></div>
    <div class="overlay grey" id="grey"></div>
</div>
<div class="loading_screen" id="loading_screen">
    <div class="loading_circle"></div>
</div>
<div id="js-scroll" class="main" data-scroll-container>
    <section class="main">
        <div class="title wrapper">
            <h1><?php echo $p ?></h1>
			<div class="maininfo">
				<p> имя:
				<?php echo $name, ' ', $surname . '<br>';
					  echo 'планета:', ' ', $city; ?>
				<br>
				возраст: <?php  echo $age;   ?> лет </p>
				
			</div>
			<?php include 'logo.inc.php' ?>
            <div class="infolist">
				<div class="knowledge">
                <p class="small"> 
					<?php  include 'knowledge.inc.php'; ?>
					<?php   echo $a, ' ', $b, ' ', $c; ?> <br>
					<?php
						$a = 10;
						$b = 20;
						$c = $a + $b;
						echo '10+20=', $c;
					?>   
					<br>
					<?php
						echo $d;
					?>
					<br>
					<?php
						echo 'прошло ' . round(microtime(true) - $tStart, 5) . ' сек';
					?>
				</p>
				</div>
                <p class="small"> <a href="#">Элемент меню один</a></p>
                <p class="small"> <a href="#">Элемент меню два</a></p>
                <p class="small"> <a href="#">Элемент меню три</a></p>

            </div>
        </div>
    </section>
	<?php include 'footer.inc.php' ?>
	
</div>
<script src="js/script.js"></script>
</body>
</html>