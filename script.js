
      // Smooth scrolling for navigation links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Navbar background on scroll
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });

      // Counter animation
      function animateCounters() {
        const counters = document.querySelectorAll(".stat-number");
        counters.forEach((counter) => {
          const target = parseInt(counter.getAttribute("data-count"));
          const increment = target / 100;
          let current = 0;

          const updateCounter = () => {
            if (current < target) {
              current += increment;
              counter.textContent = Math.floor(current);
              setTimeout(updateCounter, 20);
            } else {
              counter.textContent = target;
            }
          };

          updateCounter();
        });
      }

      // Intersection Observer for scroll animations
      const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");

            // Trigger counter animation when stats section is visible
            if (entry.target.querySelector(".stat-number")) {
              animateCounters();
            }
          }
        });
      }, observerOptions);

      // Observe all scroll animation elements
      document.querySelectorAll(".scroll-animation").forEach((el) => {
        observer.observe(el);
      });

      // Search functionality
      function performSearch() {
        const searchTerm = document.getElementById("searchInput").value;
        if (searchTerm.trim() === "") {
          alert("Masukkan kata kunci pencarian");
          return;
        }

        // Simulate search (in real implementation, this would call an API)
        console.log("Searching for:", searchTerm);
        alert(`Mencari data dengan kata kunci: "${searchTerm}"`);
      }

      // Enter key search
      document
        .getElementById("searchInput")
        .addEventListener("keypress", function (e) {
          if (e.key === "Enter") {
            performSearch();
          }
        });

      // Tag click functionality
      document.querySelectorAll(".badge").forEach((badge) => {
        badge.addEventListener("click", function () {
          const tag = this.textContent.replace("#", "");
          document.getElementById("searchInput").value = tag;
          performSearch();
        });
      });

      // Table row click functionality
      document.querySelectorAll(".table-modern tbody tr").forEach((row) => {
        row.addEventListener("click", function () {
          const dataset = this.querySelector("strong").textContent;
          console.log("Selected dataset:", dataset);
          // In real implementation, this would open dataset details
          alert(`Membuka detail dataset: ${dataset}`);
        });
      });

      // Loading animation on page load
      window.addEventListener("load", function () {
        document.querySelectorAll(".loading").forEach((el) => {
          el.style.opacity = "1";
          el.style.transform = "translateY(0)";
        });
      });

      // Service card hover effects
      document.querySelectorAll(".service-card").forEach((card) => {
        card.addEventListener("mouseenter", function () {
          this.style.transform = "translateY(-10px) scale(1.02)";
        });

        card.addEventListener("mouseleave", function () {
          this.style.transform = "translateY(0) scale(1)";
        });
      });

      // Download button functionality
      document
        .querySelectorAll('button[class*="btn-outline-primary"]')
        .forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const format = this.textContent.trim();
            console.log(`Downloading in ${format} format`);

            // Simulate download
            this.innerHTML =
              '<i class="fas fa-spinner fa-spin me-1"></i>Downloading...';
            this.disabled = true;

            setTimeout(() => {
              this.innerHTML = `<i class="fas fa-check me-1"></i>Downloaded`;
              this.classList.remove("btn-outline-primary");
              this.classList.add("btn-success");

              setTimeout(() => {
                this.innerHTML = `<i class="fas fa-download me-1"></i>${format}`;
                this.classList.remove("btn-success");
                this.classList.add("btn-outline-primary");
                this.disabled = false;
              }, 2000);
            }, 1500);
          });
        });

      // Navbar active link
      window.addEventListener("scroll", function () {
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".nav-link");

        let current = "";
        sections.forEach((section) => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.clientHeight;
          if (scrollY >= sectionTop - 200) {
            current = section.getAttribute("id");
          }
        });

        navLinks.forEach((link) => {
          link.classList.remove("active");
          if (link.getAttribute("href") === `#${current}`) {
            link.classList.add("active");
          }
        });
      });
