function initModernExperience() {
    // 1. Initialize Smooth Scrolling (Lenis) - Defensive Check
    let lenis;
    try {
        if (typeof Lenis !== 'undefined') {
            lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                direction: 'vertical',
                gestureDirection: 'vertical',
                smooth: true,
                mouseMultiplier: 1,
                smoothTouch: false,
                touchMultiplier: 2,
            });

            // Link Lenis to ScrollTrigger
            lenis.on('scroll', ScrollTrigger.update);

            gsap.ticker.add((time) => {
                lenis.raf(time * 1000);
            });

            gsap.ticker.lagSmoothing(0);
            console.log("Lenis initialized successfully.");
        } else {
            console.warn("Lenis library not found. Smooth scrolling disabled, but animations will continue.");
        }
    } catch (e) {
        console.error("Error initializing Lenis:", e);
    }

    // 2. Initialize GSAP ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // 3. Cinematic Hero Entry
    // (Existing hero animations...)
    const heroTimeline = gsap.timeline();

    heroTimeline.from(".hero-subtitle-pill", {
        y: -30, opacity: 0, duration: 1, ease: "power3.out"
    })
        .from(".hero-title-massive", {
            y: 50, opacity: 0, duration: 1.5, ease: "power4.out", skewY: 5
        }, "-=0.5")
        .from(".lead", {
            y: 20, opacity: 0, duration: 1, ease: "power2.out"
        }, "-=1")
        .from(".curved-dock-container", {
            y: 100, opacity: 0, duration: 1.2, ease: "back.out(1.7)"
        }, "-=0.8")
        .from(".pill-nav-item", {
            y: 20, opacity: 0, duration: 0.8, stagger: 0.1, ease: "power2.out"
        }, "-=0.5");

    // Floating Abstract Shapes
    gsap.to(".abstract-shape", {
        y: 30, duration: 4, repeat: -1, yoyo: true, ease: "sine.inOut",
        stagger: { each: 2, from: "random" }
    });

    // Parallax Background
    gsap.to(".hero-bg", {
        scrollTrigger: { trigger: ".hero-visionary", start: "top top", end: "bottom top", scrub: true },
        yPercent: 30, scale: 1.1
    });

    // 4. Bento Grid Staggered Entry
    const cards = gsap.utils.toArray('.bento-card');
    cards.forEach((card) => {
        gsap.from(card, {
            scrollTrigger: { trigger: card, start: "top bottom-=100", toggleActions: "play none none reverse" },
            y: 100, opacity: 0, duration: 0.8, ease: "back.out(1.7)"
        });
    });

    // 5. Stat Parsers (Counter Animation)
    const stats = gsap.utils.toArray('.stat-number');
    stats.forEach((stat) => {
        const target = parseInt(stat.getAttribute('data-target'));
        gsap.to(stat, {
            scrollTrigger: { trigger: stat, start: "top 80%" },
            innerHTML: target, duration: 2, snap: { innerHTML: 1 },
            onUpdate: function () {
                stat.innerHTML = Math.ceil(this.targets()[0].innerHTML) + (stat.getAttribute('data-suffix') || '');
            }
        });
    });

    // 6. Sticky News Scroll Logic (Refined)
    const newsBlocks = gsap.utils.toArray('.news-block');
    const newsImages = gsap.utils.toArray('.news-img');

    newsBlocks.forEach((block, i) => {
        ScrollTrigger.create({
            trigger: block,
            start: "top 50%",
            end: "bottom 50%",
            onEnter: () => activateNewsBlock(i),
            onEnterBack: () => activateNewsBlock(i),
            onLeave: () => { if (i === newsBlocks.length - 1) block.classList.remove('active'); },
            onLeaveBack: () => { if (i === 0) block.classList.remove('active'); }
        });
    });

    function activateNewsBlock(index) {
        // Update Text Classes
        newsBlocks.forEach((b, i) => {
            if (i === index) b.classList.add('active');
            else b.classList.remove('active');
        });

        // Update Images
        newsImages.forEach((img, i) => {
            if (i === index) {
                img.classList.add('active');
                gsap.set(img, { zIndex: 10 });
                gsap.fromTo(img, { scale: 1.1, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.8, ease: "power2.out" });
            } else {
                img.classList.remove('active');
                gsap.set(img, { zIndex: 1 });
                gsap.to(img, { opacity: 0, duration: 0.5 });
            }
        });
    }

    // 7. Sticky Class Toggle
    const header = document.querySelector('#header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) header.classList.add('glass-sticky');
            else header.classList.remove('glass-sticky');
        });
    }

    // Final Refresh to ensure GSAP knows about the page layout
    setTimeout(() => {
        ScrollTrigger.refresh();
    }, 100);
} // End of initModernExperience

// Wait for DOM
document.addEventListener('DOMContentLoaded', initModernExperience);
