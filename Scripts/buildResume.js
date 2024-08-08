document.addEventListener("DOMContentLoaded", (event) => {
    // gsap.registerPlugin(TextPlugin, RoughEase, ExpoScaleEase, SlowMo, CustomEase)
    // gsap code here!
    function getRandomQuote() {
        let someWords = [
            "Unlock Your Dream Job",
            "Your Resume to Career Success",
            "Job Magnet The Perfect Resume",
            "Resume Builder Get Hired Fast",
            "Nail Your Dream Job with This Resume",
        ]
        return someWords[Math.floor(Math.random() * someWords.length)];
    }
    gsap.to(".mainHeading", {
        duration: 2,
        text: getRandomQuote(),
        ease: "steps(25)",
    });
    gsap.to("#buildNowBtn", {
        delay: 2,
        duration: 1,
        style: "opacity:1;",
        ease: "elastic.out(1, 0.3)",
    })
    gsap.to("#parahTag", {
        delay: 2,
        duration: 1,
        style: "opacity:1;",
        ease: "elastic.out(1, 0.3)",
    })
});
