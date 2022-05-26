const can = document.querySelector('#canvas');
const ctx = can.getContext('2d');
const count = 50;
const dist = 150;
let dots = new Array;

canvas.width = 500;
canvas.height = 1000;
canvas.style.position = 'absolute';
canvas.style.height = '85%';
canvas.style.minHeight = '400px';
canvas.style.top = '50%';
canvas.style.left = '50%';
canvas.style.top = '50%';
canvas.style.transform = 'translate(-50%, -50%)';
canvas.style.marginLeft = '100px';
ctx.fillStyle = '#ccc';
ctx.strokeStyle = '#ccc';

for (let i = 0; i < count; i++) {
    dots[i] = {
        size: Math.random() * 4 + 2,
        speed: Math.random() * 2 + 1,
        vx: Math.random() * 2 - 1,
        vy: Math.random() * 3 - 1.5,
        x: Math.random() * can.width,
        y: Math.random() * can.height
    }
}

function get_dist(d1, d2)
{
    return Math.sqrt(Math.pow((d1.x - d2.x), 2) + Math.pow((d1.y - d2.y), 2));
}

function update()
{
    for (let i = 0; i < count; i++) {
        dots[i].x += dots[i].vx * dots[i].speed;
        dots[i].y += dots[i].vy * dots[i].speed;
        dots[i].x > can.width ? dots[i].vx = -dots[i].vx : dots[i].vx = dots[i].vx;
        dots[i].x < 0 ? dots[i].vx = -dots[i].vx : dots[i].vx = dots[i].vx;
        dots[i].y > can.height ? dots[i].vy = -dots[i].vy : dots[i].vy = dots[i].vy;
        dots[i].y < 0 ? dots[i].vy = -dots[i].vy : dots[i].vy = dots[i].vy;
    }
    draw();
    requestAnimationFrame(update);
}

function draw()
{
    ctx.clearRect(0, 0, can.width, can.height);
    for (let i = 0; i < count; i++) {
        let d = dots[i];
        ctx.beginPath();
        ctx.arc(d.x, d.y, d.size, 0, 360);
        ctx.fill();
        for (let j = i + 1; j < count; j++) {
            let d1 = dots[j];
            if (get_dist(d, d1) < dist)
            {
                ctx.beginPath();
                ctx.moveTo(d.x, d.y);
                ctx.lineTo(d1.x, d1.y);
                ctx.stroke();
            }
        }
    }
}
update();