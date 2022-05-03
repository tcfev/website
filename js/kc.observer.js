const scrollers = document.querySelectorAll('[class*="scroll-effect-"');
const scrollOptions = {
    threshold: 0,
    rootMargin: "0px 0px -350px 0px"
}
const scrollObserver = new IntersectionObserver(function(entries, scrollObserver){
    entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('onscreen');
        scrollObserver.unobserve(entry.target);
    })
}, scrollOptions);


scrollers.forEach(scroller => {
    scrollObserver.observe(scroller);
})

const specialScroller = document.querySelectorAll('[class*="scroll-special-"');
const specialScrollOptions = {
    threshold: 0.98,
    rootMargin: "0px 0px 0px 0px"
}
const specialScrollObserver = new IntersectionObserver(function(entries, specialScrollObserver){
    entries.forEach(entry => {
        if (!entry.isIntersecting)
        {
            entry.target.classList.remove('onscreen');
            return;
        }
        entry.target.classList.add('onscreen');
        // specialScrollObserver.unobserve(entry.target);
    })
}, specialScrollOptions);


specialScroller.forEach(scroller => {
    specialScrollObserver.observe(scroller);
})