const $ = jQuery.noConflict();

class VideoBackground {
	constructor() {
		this.video = $('.video-bg');
		this.ytVideo = this.video.find('.yt-player');
	}
	init() {
		this.initYTVideo();
		this.setIframeRatio();
		this.setIframeSize();
		this.video.filter((i, el) => !$(el).children('.yt-player').length).addClass('active');
	}
	setIframeRatio() {
		this.video.each((i, el) => {
			const iframe = $(el).find('iframe');
			const width = iframe.attr('width');
			const height = iframe.attr('height');
			iframe.attr('data-ratio', (width / height).toFixed(2));
		});
	}
	setIframeSize() {
		this.video.each((i, el) => {
			const parent = $(el);
			const width = parent.outerWidth();
			const height = parent.outerHeight();
			const parentRatio = width / height;
			const iframe = parent.find('iframe');
			const iframeRatio = iframe.attr('data-ratio');
			let iframeWidth = width;
			let iframeHeight = height;

			if (parentRatio > iframeRatio) {
				// viewport is wider than video, adjust the height
				iframeHeight = width / iframeRatio;
			} else {
				// viewport is taller than video, adjust the width
				iframeWidth = height * iframeRatio;
			}

			iframe.css({
				width: Math.ceil(iframeWidth),
				height: Math.ceil(iframeHeight)
			});
		});
	}
	initYTVideo() {
		window.onYouTubeIframeAPIReady = () => {
			this.ytVideo.each((i, el) => {
				const id = $(el).data('id');
				var player;
				player = new YT.Player(`yt-player-${id}`, {
					videoId: `${id}`,
					playerVars: {
						autoplay: 1,
						controls: 0,
						disablekb: 1,
						fs: 0,
						cc_load_policy: 0,
						iv_load_policy: 3,
						loop: 1,
						modestbranding: 1,
						rel: 0,
						showinfo: 0,
						mute: 1,
						playlist: `${id}`,
					},
					events: {
						'onReady': (event) => {
							event.target.mute();
							event.target.playVideo();
							this.setIframeRatio();
							this.setIframeSize();
							this.video.addClass('active');
						},
					}
				});
			});
		};
	}
	resized() {
		this.setIframeSize();
	}
}
export default new VideoBackground();
