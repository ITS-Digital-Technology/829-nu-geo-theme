const focusArea = () => {
    const btn = document.querySelector('.staff-focus__btn');

    if (btn) {
        btn.addEventListener('click', ()=> {
            const wrapper = btn.closest('.staff-focus');
            wrapper.classList.toggle('staff-focus--open');
        })
    }
}

export default focusArea;