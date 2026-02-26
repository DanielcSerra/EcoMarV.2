let introDone = false;

window.addEventListener('load', () => {
  const intro = document.getElementById('intro-overlay');
  const img = intro.querySelector('img');

  
  setTimeout(() => {
    img.style.transform = 'translateY(-170vh)'; 
  }, 500);

  
  setTimeout(() => {
    intro.style.display = 'none';
    introDone = true;

    
    const container3D = document.getElementById("container3D");
    if (container3D) {
      const canvas = container3D.querySelector("canvas");
      if (canvas) {
        canvas.style.transition = "opacity 1s ease";
        canvas.style.opacity = "1"; 
      }
    }

    
    if (object && typeof startDropAnimation === 'function') {
      startDropAnimation();
    }

    
    if (typeof animateCounter === 'function') {
      setTimeout(() => animateCounter(), 400);
    }
  }, 2000); 
});





document.addEventListener('DOMContentLoaded', function() {
    
    
    const supportBtn = document.querySelector('.support-btn');
    if (supportBtn) {
        supportBtn.addEventListener('click', function() {
            
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'translateY(-2px)';
            }, 150);
            
            
            console.log('Support button clicked!');
            
            
            
        });
    }
    
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    
    const video = document.querySelector('.video-background');
    if (video) {
        video.addEventListener('loadstart', function() {
            console.log('Video started loading');
        });
        
        video.addEventListener('canplay', function() {
            console.log('Video can play');
        });
        
        video.addEventListener('error', function(e) {
            console.log('Video error:', e);
            
            video.style.display = 'none';
        });
    }
    
    
    function animateCounter() {
        const counter = document.querySelector('.counter-text');
        if (counter) {
            const target = 4500;
            const duration = 2000; 
            const start = performance.now();
            
            function updateCounter(currentTime) {
                const elapsed = currentTime - start;
                const progress = Math.min(elapsed / duration, 1);
                
                
                const easeOut = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(easeOut * target);
                
                counter.textContent = current + '+';
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                }
            }
            
            requestAnimationFrame(updateCounter);
        }
    }
    
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                
                
                observer.unobserve(entry.target);
            }
        });
    });
    
    const counterElement = document.querySelector('.counter-text');
    if (counterElement) {
        observer.observe(counterElement);
    }
    
    
    function adjustTextSize() {
        const container = document.querySelector('.container2');
        const containerWidth = container.offsetWidth;
        
        
        if (containerWidth < 480) {
            document.documentElement.style.setProperty('--main-text-size', '1.5rem');
            document.documentElement.style.setProperty('--counter-text-size', '1.75rem');
        } else if (containerWidth < 768) {
            document.documentElement.style.setProperty('--main-text-size', '2rem');
            document.documentElement.style.setProperty('--counter-text-size', '2.25rem');
        } else {
            document.documentElement.style.setProperty('--main-text-size', '3.5rem');
            document.documentElement.style.setProperty('--counter-text-size', '3.75rem');
        }
    }
    
    
    adjustTextSize();
    window.addEventListener('resize', adjustTextSize);
    
    console.log('EcoMar website loaded successfully!');
});



const s = document.querySelector('.section2');
if (s) {
    const observer = new IntersectionObserver(([entry]) => {
        const r = entry.intersectionRatio;
        const rect = entry.boundingClientRect;

        
        if (rect.top > 0) {  
            
            const p = Math.min(1, r / 0.60);
            const scale = 0.80 + 0.20 * p;
            const ty = (1 - scale) * 280;
            s.style.transform = `translate3d(0,${ty.toFixed(4)}px,0) scale(${scale},${scale})`;
        } else {
            
            s.style.transform = `translate3d(0,0,0) scale(1,1)`;
        }
    }, { threshold: Array.from({ length: 101 }, (_, i) => i * 0.01) });

    observer.observe(s);
}



const block  = document.querySelector('.middle-container');
const counterEl = document.querySelector('.counter-text');

window.addEventListener('load', () => {
    setTimeout(() => block.classList.add('slide-in'), 150); 

    setTimeout(() => {               
        if (!counterEl) return;
        const target   = 4500;
        const duration = 1700;       
        const step     = target / (duration / 16);
        let current    = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
                counterEl.textContent = '4500+';
            } else {
                counterEl.textContent = Math.floor(current);
            }
        }, 16);
    }, 900);
});


function runCount(elId, target, suffix, dur = 1700) {
    const el = document.getElementById(elId);
    if (!el) return;
    const step = target / (dur / 16);
    let n = 0;
    const t = setInterval(() => {
        n += step;
        if (n >= target) { clearInterval(t); el.textContent = target + suffix; }
        else el.textContent = Math.floor(n);
    }, 16);
}

const container3 = document.querySelector('.container3');
if (container3) {   
    new IntersectionObserver((e, o) => {
        if (e[0].intersectionRatio >= 0.40) {   
            runCount('stat1', 120, '+');
            runCount('stat3', 5000, '+');
            o.unobserve(container3);            
        }
    }, { threshold: 0.40 }).observe(container3);
}



const textObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach(en => {
            if (en.intersectionRatio >= 0.30) {
                en.target.classList.add('in-view');      
            }
            if (en.intersectionRatio === 0) {
                en.target.classList.remove('in-view');   
            }
        });
    },
    { threshold: [0, 0.30, 1] }   
);

document.querySelectorAll('.text-container, .right-box').forEach(box => {
    const txt = box.querySelector('.main-text');
    if (txt) textObserver.observe(txt);
});

const textObserver2 = new IntersectionObserver(
    (entries) => {
        entries.forEach(en => {
            if (en.intersectionRatio >= 0.30) {
                en.target.classList.add('in-view');
            }
            if (en.intersectionRatio === 0) {
                en.target.classList.remove('in-view');
            }
        });
    },
    { threshold: [0, 0.30, 1] }
);

document.querySelectorAll('.main-text2').forEach(el => textObserver2.observe(el));






import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";

import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";

import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";


const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);


let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;


let object;


let objToRender = 'plastic_water_bottle';


const loader = new GLTFLoader();



loader.load(
  `./models/${objToRender}/scene.gltf`,
  function (gltf) {
    object = gltf.scene;
    scene.add(object);

    object.visible = false;

    
    object.position.set(0, 40, 0);

    
    const targetPosition = new THREE.Vector3(16, -16, 0);

    
    let progress = 0;
    const duration = 240; 
    const swingAmount = 0.35;

    function dropAnimation() {
      if (progress < 1) {
        progress += 1 / duration;

        
        const t = 1 - Math.pow(1 - progress, 6);

        
        object.position.y = 40 + (targetPosition.y - 40) * t;
        object.position.x = 0 + (targetPosition.x - 0) * t;

        
        object.rotation.z = Math.sin(progress * Math.PI * 0.8) * swingAmount;
        object.rotation.y = Math.sin(progress * Math.PI * 0.8) * 0.1;

        requestAnimationFrame(dropAnimation);
      } else {
        
        const finalPos = object.position.clone();
        const finalRot = object.rotation.clone();

        
        startIdleAnimation(finalPos, finalRot);
      }
    }

    
    function startIdleAnimation(startPos, startRot) {
      let idleTime = Math.PI / 1.4;
      const floatHeight = 1.0; 
      const rotationRange = 0.2;

      function idle() {
        if (object) {
          idleTime += 0.02;

          
          object.position.x = startPos.x + Math.sin(idleTime * 0.4) * 0.3;
          object.position.y = startPos.y + Math.sin(idleTime) * floatHeight;
          object.position.z = startPos.z + Math.cos(idleTime * 0.3) * 0.2;

          
          object.rotation.x = startRot.x + Math.sin(idleTime * 0.5) * rotationRange * 0.6;
          object.rotation.y = startRot.y + Math.sin(idleTime * 0.7) * rotationRange;
          object.rotation.z = startRot.z + Math.cos(idleTime * 0.5) * rotationRange * 0.4;
        }
        requestAnimationFrame(idle);
      }
      idle();
    }

    
    function startDropAnimation() {
    if (!object) return;

    object.visible = true; 
    dropAnimation();
    }
    window.startDropAnimation = startDropAnimation;

    if (introDone) {
      startDropAnimation();
    }


  },
  function (xhr) {
    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
  },
  function (error) {
    console.error(error);
  }
);



const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);

renderer.domElement.style.position = "fixed";
renderer.domElement.style.top = "0";
renderer.domElement.style.left = "0";
renderer.domElement.style.zIndex = "99";
renderer.domElement.style.pointerEvents = "none";


let targetScroll = 0;
let smoothScroll = 0;


const scrollStart = 150; 
const scrollStrength = 0.005; 

window.addEventListener("scroll", () => {
  targetScroll = window.scrollY;
});

function applyScrollEffect() {
  if (object) {
    
    smoothScroll += (targetScroll - smoothScroll) * 0.02;

    
    const scrollDelta = Math.max(0, smoothScroll - scrollStart);

    
    const scrollStrength = 0.0008;
    const scrollFactor = scrollDelta * scrollStrength;

    
    const targetY = -16 - scrollFactor * 0.5;

    
    const maxRightScroll = 600; 
    const limitedDelta = Math.min(scrollDelta, maxRightScroll - scrollStart);
    const limitedFactor = limitedDelta * scrollStrength;

    
    const targetX = 16 + limitedFactor * 200;

    
    object.position.x += (targetX - object.position.x) * 0.07;
    object.position.y += (targetY - object.position.y) * 0.07;

    
    object.rotation.y += scrollFactor * 0.02;
    object.rotation.z += Math.sin(scrollFactor * 1.2) * 0.002;

    
    let scale = 1;
    if (scrollDelta > maxRightScroll - scrollStart) {
      const extraScroll = scrollDelta - (maxRightScroll - scrollStart);
      const scaleFactor = extraScroll * 0.0006; 
      scale = 1 - Math.min(scaleFactor, 0.75);  
    }

    object.scale.set(scale, scale, scale);
  }

  requestAnimationFrame(applyScrollEffect);
}
applyScrollEffect();




const section3 = document.querySelector('.section3');
if (section3) {
  const checkSectionVisibility = () => {
    const rect = section3.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    const sectionHeight = rect.height;

    
    const visibleTop = Math.max(0, windowHeight - rect.top);
    const visiblePercent = visibleTop / sectionHeight;

    
    if (visiblePercent >= 0.8) {
      renderer.domElement.style.transition = 'opacity 0.6s ease';
      renderer.domElement.style.opacity = '0';
      renderer.domElement.style.zIndex = '-1';
    } else {
      renderer.domElement.style.transition = 'opacity 0.6s ease';
      renderer.domElement.style.opacity = '1';
      renderer.domElement.style.zIndex = '99';
    }
  };

  window.addEventListener('scroll', checkSectionVisibility);
  window.addEventListener('resize', checkSectionVisibility);
  checkSectionVisibility();
}



document.getElementById("container3D").appendChild(renderer.domElement);


camera.position.z = objToRender === "plastic_water_bottle" ? 15 : 500;


const topLight = new THREE.DirectionalLight(0xffffff, 1);
topLight.position.set(500, 500, 500);
topLight.castShadow = true;
scene.add(topLight);

const ambientLight = new THREE.AmbientLight(0x333333, objToRender === "plastic_water_bottle" ? 5 : 1);
scene.add(ambientLight);


function animate() {
  requestAnimationFrame(animate);

  if (object && objToRender === "plastic_water_bottle") {
    object.rotation.y = -3 + mouseX / window.innerWidth * 3;
    object.rotation.x = -1.2 + mouseY * 2.5 / window.innerHeight;
  }

  renderer.render(scene, camera);
}


window.addEventListener("resize", function () {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
});


animate();