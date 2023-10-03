$(function()
{
    var app = $('#app'), init = $('#init'), layer = $('#layer'), input = $('#inp-cover input'), button = $('button');

    function toggleApp()
    {
        app.toggleClass('opened');

        if( button.hasClass('shadow') )
            button.toggleClass('shadow');
        else
            setTimeout(function(){ button.toggleClass('shadow'); },300);

        if( app.hasClass('opened') )
        {
            setTimeout(function(){ input.toggleClass('move-up'); },200);
            setTimeout(function(){ input.focus(); },500);
        }
        else
            setTimeout(function(){ input.toggleClass('move-up').val(''); },200);

        if( ! layer.hasClass('sl') )
        {
            setTimeout(function()
            {  
                layer.addClass('sl');
            },800);
        }
        else
            setTimeout(function(){ layer.removeClass('sl'); },300);
    }

    layer.on('click',toggleApp);
    init.on('click',toggleApp);
});


//coursel

let sliderIndex = 1;
let timeout;
const layers = [...document.querySelectorAll('.layer1')];
const covers = [...document.querySelectorAll('.photo-frame')];

function changeCoverAnimState(state = 0) {
  const st = state === 1 ? 'running' : 'paused';
  covers.forEach(cover => {
    // cover.style['animation-play-state'] = st;
    cover.querySelector('.cover').style.width = `${state * 100}%`;
  });
}

function switchLayer(step = 1) {
  const nextSlide = (sliderIndex + step) % 3 === 0 ? 3 : (sliderIndex + step) % 3;
  
  changeCoverAnimState(1);
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    changeCoverAnimState(0)
  }, 500);
  
  for(let i of layers) {
    i.classList.remove('layer-displayed');
    i.classList.remove('layer-displayed-exit');
    if(i.dataset.scene == nextSlide) {
      i.classList.add('layer-displayed');
    }
    if(i.dataset.scene == sliderIndex) {
      i.classList.add('layer-displayed-exit');
    }
  }
  sliderIndex = nextSlide;
}

