const vhUnit = () => {
	document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
};

export default vhUnit;
