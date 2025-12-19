// ⭐ Navbar js
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  let open = false;

  menuBtn.onclick = () => {
    mobileMenu.classList.toggle('-translate-y-full');
    mobileMenu.classList.toggle('opacity-0');
    mobileMenu.classList.toggle('pointer-events-none');

    mobileMenu.classList.toggle('translate-y-0');
    mobileMenu.classList.toggle('opacity-100');
    mobileMenu.classList.toggle('pointer-events-auto');

    open = !open;
    menuBtn.innerHTML = open
      ? '<i class="fas fa-times text-[#4DA6FF]"></i>'
      : '<i class="fas fa-bars text-[#4DA6FF]"></i>';
  };

// ⭐ Project Section js
const filterBtns = document.querySelectorAll(".filter-btn");
const projects = document.querySelectorAll(".project-card");
const slider = document.getElementById("slider"); 

filterBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        filterBtns.forEach(b => b.classList.remove("filter-active"));
        btn.classList.add("filter-active");
        
        const filter = btn.dataset.filter;
        
        projects.forEach(p => {
            const isVisible = (filter === "all" || p.dataset.category === filter);
            if (isVisible) {
                p.style.display = "block";
                p.classList.add("snap-start"); 
            } else {
                p.style.display = "none";
                p.classList.remove("snap-start"); 
            }
        });

        slider.scrollTo({ left: 0, behavior: 'smooth' });
    });
});

// ⭐ Slider arrows
document.getElementById("slideLeft").addEventListener("click", () => {
    slider.scrollBy({ left: -300, behavior: 'smooth' });
});
document.getElementById("slideRight").addEventListener("click", () => {
    slider.scrollBy({ left: 300, behavior: 'smooth' });
});


// ⭐ Skill js
  document.querySelectorAll(".skill-circle").forEach(circle => {
    let percent = circle.getAttribute("data-skill");
    let radius = circle.r.baseVal.value;
    let circumference = 2 * Math.PI * radius;

    circle.style.strokeDasharray = circumference;
    circle.style.strokeDashoffset = circumference;

    setTimeout(() => {
      circle.style.strokeDashoffset = circumference - (percent / 100) * circumference;
    }, 200);
  });

// ⭐ Right Button - Scroll to Top
const rightBtn = document.querySelector('button[aria-hidden]:last-of-type');
rightBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
