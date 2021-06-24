function wcagHelper() {
  function removeNavIds() {
    const menuItems = document.querySelectorAll('.main-header__mobile li, .main-header__right li');

    if (menuItems) {
      menuItems.forEach(menuItem => {
        const id = menuItem.getAttribute('id');

        if(id) {
          menuItem.removeAttribute('id');
          menuItem.classList.add(id);
        }
      });
    }
  }

  function anchorLinkMenu() {
    const body = document.querySelector('body');
    const menuLinks = document.querySelectorAll('#menu-information-1 a');

    if (body.classList.contains('page-id-1848') && menuLinks) {
      menuLinks.forEach(menuLink => {
        menuLink.addEventListener('click', function(e) {
          const path = menuLink.getAttribute('href').split('#');
          const id = path[1];
          const element = document.querySelector(`#${id}`);

          e.preventDefault();

          if (element) {
            window.scrollTo({
              top: element.offsetTop - 130,
              left: 0,
              behavior: 'smooth'
            });
          }
        });
      });
    }
  }

  function blockIds() {
    const blocks = document.querySelectorAll('.page-content > section');
    let i = 0;

    if (blocks) {
      blocks.forEach(block => {
        const id = block.getAttribute('id');
        
        if (!id) {
          i++;
          block.setAttribute('id', `block-${i}`);
        }
      });
    }
  }

  function topLevelNav() {
    const menuItems = document.querySelectorAll('.main-header__mobile ul > li > a, .main-header__right ul > li > a');
    const menuWrappers = document.querySelectorAll('.mega-menu-wrapper');

    if(menuItems) {
      menuItems.forEach(menuItem => {
        if (menuItem.getAttribute('href') === '#') {
          const label = menuItem.textContent;

          menuItem.removeAttribute('href');
          menuItem.classList.add('menu-trigger'); 
          //menuItem.setAttribute('aria-label', `Toggle ${label} dropdown menu`);
          menuItem.setAttribute('aria-haspopup', true);
          menuItem.setAttribute('aria-expanded', false);

          menuItem.addEventListener('click', function(e) {
            const currentMenuStatus = menuItem.classList.contains('active') ? true : false;

            e.preventDefault();
            menuItem.setAttribute('aria-expanded', currentMenuStatus);
          });
        }
      });
    }

    if (menuWrappers && menuItems) {
      //close on esc
      window.addEventListener('keydown', function(e){
        if (e.key === 'Escape') {
          menuWrappers.forEach(menuWrapper => {
            if (menuWrapper.classList.contains('active')) {
              menuWrapper.previousElementSibling.focus();
            }
          });

          document.querySelector('body').click();
        }
      }); 

      //close on focusout
      menuWrappers.forEach(menuWrapper => {
        const menuParent = menuWrapper.closest('.menu-item');

        menuWrapper.addEventListener('focusout', function(e) {
          if (!menuWrapper.contains(e.relatedTarget)) {
            menuParent.querySelector('a.menu-trigger').click();
          }
        });
      });

      const triggers = document.querySelectorAll('#menu-main-nav-1 .menu-trigger, .main-header__logo, .main-header__search-button');

      if (triggers) {
        triggers.forEach(trigger => {
          trigger.addEventListener('focusin', function() {
            menuWrappers.forEach(menuWrapper => {
              if (menuWrapper.classList.contains('active'));
              document.querySelector('body').click();
            });
          });
        });
      }
    }
  }

  function tribesFilterBar() {
    const formFields = document.querySelectorAll('form.tribe-filter-bar__form input[type="checkbox"]');
    const fieldSets = document.querySelectorAll('fieldset.tribe-filter-bar-c-filter__filters-fieldset');
    const headingTitle = document.querySelectorAll('h1');
    const pageTitle = headingTitle[0] ? headingTitle[0].textContent : '';

    if (formFields) {
      formFields.forEach(formField => {
        const label = formField.nextElementSibling.textContent.trim();

        if (label) {
          formField.setAttribute('aria-label', label);
        }
      });
    }

    if(fieldSets) {
      fieldSets.forEach(fieldSet => {
        const innerElement = fieldSet.querySelector('.tribe-filter-bar-c-filter__filter-fields');
        let i = 0;

        if (innerElement) {
          innerElement.setAttribute('role', 'group');
          innerElement.setAttribute('aria-label', `Event filters for ${pageTitle} ${i}`);
        }

        i++;
      });
    }
  }

  function iframes() {
    const iframes = document.querySelectorAll('iframe');

    if (iframes) {
      iframes.forEach(iframe => {
        iframe.removeAttribute('frameborder');
      });
    }
  }

  function selectAll() {
    const filters = document.querySelectorAll('.program-filters__filter-list');

    if (filters) {
      filters.forEach(filter => {
        const inputs = filter.querySelectorAll('.program-filters__filter-list-item input');
        const filterParent = filter.closest('.program-filters__filter');
        const label = filterParent.querySelector('.program-filters__filter-label');
        const button = filterParent.querySelector('.program-filters__filter-trigger');

        button.addEventListener('click', function() {
          const items = filterParent.querySelectorAll('li:not(.select-all) input').length;
          const itemsSelected = filterParent.querySelectorAll('li:not(.select-all) input:checked').length;

          if (items !== itemsSelected) {
            filterParent.querySelector('input[data-id="all"]').removeAttribute('data-all-selected');
          }

        });

        if (inputs) {
          const totalTerms = inputs.length - 1;

          inputs.forEach(input => {
            input.addEventListener('change', function() {
              const parent = input.closest('.program-filters__filter-list');
              const totalSelected = parent.querySelectorAll('li:not(.select-all) input:checked');
              const selectAll = parent.querySelector('input[data-id="all"]');

              // console.log(`total = ${totalTerms}`);
              // console.log(`selected = ${totalSelected.length}`);

              if (totalTerms === totalSelected.length) {
                //console.log('all are selected');

                if (input.getAttribute('data-id') === 'all') {
                  //console.log('uncheck everything');
                  const terms = parent.querySelectorAll('li:not(.select-all) input');
                  if (input.hasAttribute('data-all-selected')) {
                    terms.forEach(term => {
                      term.click();
                    });
  
                    button.textContent = label.textContent;
                    selectAll.removeAttribute('data-all-selected');
                  }
                }

                selectAll.setAttribute('data-all-selected', "true");
              }
              else {
                selectAll.removeAttribute('data-all-selected');
              }
            });
          });
        }
      });
    }
  }

  function tabIndex() {
    const mainMenu = document.querySelector('.main-header__nav-wrapper');

    if (mainMenu) {
      const mainMenuTopItems = mainMenu.querySelectorAll('.menu-trigger');

      if (mainMenuTopItems) {
        mainMenuTopItems.forEach(mainMenuTopItem => {
          mainMenuTopItem.setAttribute('tabIndex', "0");

          mainMenuTopItem.addEventListener('keypress', function(e) {
            if (e.key === 13 || e.key === 'Enter') {
              mainMenuTopItem.click();
            }
          });
        });
      }
    }

    const rightMenu = document.querySelector('.main-header__right-wrapper');

    if (rightMenu) {
      const rightMenuButton = rightMenu.querySelector('.main-header__info-for');
      const menuWrapper = rightMenu.querySelector('.menu');
      const menuItems = rightMenu.querySelectorAll('.menu li');
      const menuItemsLinks = rightMenu.querySelectorAll('.menu li a');
      let menuStatus = rightMenuButton.classList.contains('active') ? true : false;

      rightMenuButton.setAttribute('tabIndex', "0");
      rightMenuButton.setAttribute('aria-haspopup', true);
      rightMenuButton.setAttribute('aria-expanded', menuStatus);
      rightMenuButton.setAttribute('id', 'info-for-button');
      
      if (rightMenuButton) {
        rightMenuButton.addEventListener('keydown', function(e) {
          if (e.keyCode === 13 || e.key === 'Enter' || e.key === 'Space' || e.keyCode === 32) {
            menuStatus = !menuStatus;

            rightMenuButton.classList.toggle('active');
            rightMenuButton.setAttribute('aria-expanded', menuStatus);
          }

          if (e.keyCode === 40 || e.key === 'ArrowDown') {
            document.querySelector('#menu-information-1 > li:first-child > a').focus();
          }
        });

        if (menuItemsLinks) {
          menuItemsLinks.forEach(menuItemsLink => {
            menuItemsLink.addEventListener('keydown', function(e) {
              const prevLink = menuItemsLink.parentElement.previousElementSibling ? menuItemsLink.parentElement.previousElementSibling.firstElementChild : false;
              const nextLink = menuItemsLink.parentElement.nextElementSibling ? menuItemsLink.parentElement.nextElementSibling.firstElementChild : false;

              if (e.keyCode === 38 || e.key === 'ArrowUp') {
                //move up
                if (prevLink && prevLink.tagName === 'A') {
                  prevLink.focus();
                }
              }

              if (e.keyCode === 40 || e.key === 'ArrowDown') {
                //move down
                if (nextLink && nextLink.tagName === 'A') {
                  nextLink.focus();
                }
              }
            });
          });
        }

        //menuWrapper.setAttribute('role', 'menu');
        //rightMenuButton.setAttribute('aria-controls', 'menu-information-1');
        menuWrapper.setAttribute('aria-labelledby', 'info-for-button');

        if (menuItems) {
          menuItems.forEach(menuItem => {
            const menuItemLink = menuItem.querySelector('a');

            menuItem.setAttribute('role', 'none');
            menuItemLink.setAttribute('role', 'menuitem');
          });
        }

        menuWrapper.addEventListener('focusout', function(e) {
          if (!menuWrapper.contains(e.relatedTarget)) {
            menuStatus = false;
            rightMenuButton.classList.remove('active');
            rightMenuButton.setAttribute('aria-expanded', menuStatus);
          }
        });

        window.addEventListener('click', function(e) {
          if (rightMenuButton.classList.contains('active')) {
            menuStatus = false;
            rightMenuButton.classList.remove('active');
            rightMenuButton.setAttribute('aria-expanded', menuStatus);
          }
        });

        rightMenuButton.addEventListener('click', function(e) {
          e.stopPropagation();
        });

        menuWrapper.addEventListener('click', function(e) {
          e.stopPropagation();
        });
      }
    }

    //Non React filters
    // const filters = document.querySelectorAll('.program-filters__filter');

    // if (filters) {
    //   filters.forEach(filter => {        
    //     const filterButton = filter.querySelector('button.program-filters__filter-trigger');
    //     const checkboxes = filter.querySelectorAll('input[type="checkbox"]');
    //     const filterMenu = filter.querySelector('ul.program-filters__filter-list');
    //     const filterMenuParentTrigger = filterMenu.closest('.program-filters__filter').querySelector('button.program-filters__filter-trigger');
    //     const filterLabel = filterMenuParentTrigger.textContent;

    //     function toggleMenu() {
    //       const menuStatus = filterMenuParentTrigger.classList.contains('active') ? true : false;
    //       filterMenuParentTrigger.setAttribute('aria-expanded', menuStatus);
    //     }

    //     if (filterMenu) {
    //       filterMenuParentTrigger.setAttribute('aria-expanded', false);
    //       filterMenuParentTrigger.setAttribute('aria-haspopup', true);
    //       filterMenuParentTrigger.setAttribute('aria-label', `${filterLabel}`);
    //       filterMenu.setAttribute('role', 'option');
    //     }

    //     if (filterButton) {
    //       filterButton.addEventListener('click', toggleMenu);
    //     }

    //     if (checkboxes) {
    //       checkboxes.forEach(checkbox => {
    //         checkbox.addEventListener('keypress', function(e) {
    //           if (e.key === 13 || e.key === 'Enter') {
    //             checkbox.click();
    //             filterMenuParentTrigger.setAttribute('aria-expanded', false);
    //           }
    //         });

    //         checkbox.addEventListener('click', function() {
    //           filterMenuParentTrigger.setAttribute('aria-expanded', false);
    //         });
    //       });
    //     }
    //   });
    // }
  }

  function newsletterCleanup() {
    const elements = document.querySelectorAll('#mc_embed_signup_scroll p');
    const form = document.querySelector('#mc-embedded-subscribe-form');

    if (elements) {
      elements.forEach(element => {
        const text = element.innerHTML;
        element.innerHTML = text.replaceAll('&nbsp;', '');
      });
    }

    if (form) {
      const formContent = form.innerHTML;
      form.innerHTML = formContent.replaceAll('&nbsp;', '');
    }
  }

  function accordions() {
    const accordions = document.querySelectorAll('.single-accordion');
    let i = 0;

    if (accordions) {
      accordions.forEach(accordion => {
        i++;

        let menuStatus = accordion.classList.contains('active') ? true : false;
        const accordionTrigger = accordion.querySelector('.single-accordion__title .heading');
        const accordionContent = accordion.querySelector('.single-accordion__content');

        accordion.setAttribute('id', `accordion-${i}`);
        accordionTrigger.setAttribute('aria-expanded', menuStatus);
        accordionTrigger.setAttribute('id', `accordion-trigger-${i}`);
        accordionTrigger.setAttribute('aria-controls', `accordion-content-${i}`);
        accordionContent.setAttribute('id', `accordion-content-${i}`);
        accordionContent.setAttribute('role', `region`);
        accordionContent.setAttribute('aria-labelledby', `accordion-trigger-${i}`);

        accordionTrigger.addEventListener('click', function() {
          menuStatus = !menuStatus;
          accordionTrigger.setAttribute('aria-expanded', menuStatus);
        });
      });
    }
  }

  function tabs() {
    const tabBlocks = document.querySelectorAll('.block-tabs');

    if (tabBlocks) {
      tabBlocks.forEach(tabBlock => {
        const tabButtons = tabBlock.querySelectorAll('.block-tabs__list-item');
        const tabPanels = tabBlock.querySelectorAll('.block-tabs__tab-content');

        if (tabButtons && tabPanels) {
          tabButtons.forEach(tabButton => {
            const tabStatus = tabButton.classList.contains('active') ? true : false;
            const tabButtonId = tabButton.getAttribute('data-tab').replace('#', '');

            tabButton.setAttribute('role', 'tab');
            tabButton.setAttribute('aria-selected', tabStatus);
            tabButton.setAttribute('aria-controls', `tab-content-${tabButtonId}`);
            tabButton.setAttribute('id', `tab-button-${tabButtonId}`);

            tabButton.addEventListener('click', function() {
              const currentTab = tabButton.getAttribute('data-tab').replace('#', '');

              //Reset All Buttons
              tabButtons.forEach(tabButton => {
                tabButton.setAttribute('aria-selected', false);
              });

              //Reset All Content
              tabPanels.forEach(tabPanel => {
                tabPanel.setAttribute('hidden', '');
              });

              tabBlock.querySelector(`#tab-content-${currentTab}`).removeAttribute('hidden');
              tabButton.setAttribute('aria-selected', true);
            });

            tabButton.addEventListener('keypress', function(e) {
              if (e.key === 13 || e.key === 'Enter') {
                tabButton.click();
              }
            });
          });

          //Tab Content
          tabPanels.forEach(tabPanel => {
            const tabPanelId = tabPanel.getAttribute('data-tab').replace('#', '');
            const tabPanelStatus = tabPanel.classList.contains('active') ? true : false;

            tabPanel.setAttribute('id', `tab-content-${tabPanelId}`);
            tabPanel.setAttribute('aria-labelledby', `tab-button-${tabPanelId}`);
            tabPanel.setAttribute('tabindex', 0);

            if (!tabPanelStatus) {
              tabPanel.setAttribute('hidden', '');
            }
          });
        }
      });
    }
  }

  function programSelectMenus() {
    const programFilters = document.querySelectorAll('.program-filters');

    if (programFilters) {
      programFilters.forEach(programFilter => {
        const selections = {};
        const filterMenus = programFilter.querySelectorAll('.program-filters__filter');
        const searchButton = programFilter.querySelector('.program-filters__search-wrapper > a');
        const searchButtonURL = searchButton.getAttribute('href');
        const mobileButton = programFilter.querySelector('.program-filters__trigger-mobile');
        const mobileButtonClose = programFilter.querySelector('.program-filters__mobile-close');
        const mobileModal = programFilter.querySelector('.program-filters__wrapper-outer');

        if(filterMenus && searchButton) {
          filterMenus.forEach(filterMenu => {
            const filterTitle = filterMenu.querySelector('.program-filters__filter-label').textContent;
            let selectionList = '';
            let taxonomy = filterTitle.toLowerCase();
            taxonomy = taxonomy.replaceAll(' ', '_');

            filterMenu.addEventListener('change', function(e) {
              selectionList = '';

              if (e.target.value == 'default') {
                delete selections[taxonomy];
              }
              else {
                selections[taxonomy] = e.target.value;
              }

              for (const taxonomyName in selections) {
                selectionList += `p_${taxonomyName}=${selections[taxonomyName]}&`;
              }

              const selectionString = `${searchButtonURL}?${selectionList}`;
              
              searchButton.setAttribute('href', selectionString);
            });
          });
        }

        if (mobileButton && mobileButtonClose && mobileModal) {
          mobileButton.addEventListener('click', function() {
            mobileModal.classList.toggle('active');
          });

          mobileButtonClose.addEventListener('click', function() {
            mobileModal.classList.remove('active');
          });
        }
      });
    }
  }

  function blockGalleryVideo() {
    const blocks = document.querySelectorAll('.block-gallery-video');

    if (blocks) {
      blocks.forEach(block => {
        const blockId = block.getAttribute('id');
        const lightbox = block.querySelector('.video-lightbox');
        const lightboxClose = block.querySelector('.video-lightbox__close');
        const triggers = block.querySelectorAll('.js-play-lightbox-video');
        let lastItem;

        if (triggers && lightbox) {
          lightbox.setAttribute('id', `dialog-${blockId}`);

          triggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
              lastItem = trigger;
              lightboxClose.focus();
            });
          });
        }

        window.addEventListener('keydown', function(e) {
          if ((e.keyCode === 27 || e.key === 'Escape') && lastItem && lightbox.classList.contains('active')) {
            lastItem.focus();
          }
        });

        lightboxClose.addEventListener('click', function() {
          if (lastItem) {
            lastItem.focus();
          }
        });
      });
    }
  }

  function blockGalleryLightbox() {
    const blocks = document.querySelectorAll('.block-gallery-lightbox');
    const lastBlock = document.querySelector('.page-content > :last-child');

    if (blocks) {
      blocks.forEach(block => {
        const blockId = block.getAttribute('id');
        const lightbox = block.querySelector('.block-gallery-lightbox__gallery-wrapper');
        const triggers = block.querySelectorAll('a.block-gallery-lightbox__single-thumb');
        const nextButton = block.querySelector('.slick-next');
        const closeButton = block.querySelector('.block-gallery-lightbox__close');
        let lastItem;

        if (lightbox && triggers) {
          lightbox.setAttribute('id', `photo-galley-${blockId}`);

          triggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
              lastItem = trigger;
              closeButton.focus();
            });

            trigger.addEventListener('keydown', function(e) {
              if (e.key === 'Enter') {
                closeButton.focus();
              }
            })
          });

          window.addEventListener('keydown', function(e) {
            if ((e.keyCode === 27 || e.key === 'Escape') && lastItem && lightbox.classList.contains('active')) {
              lastItem.focus();
            }
          });

          closeButton.addEventListener('click', function() {
            if (lastItem) {
              lastItem.focus();
            }
          });
        }
      });
    }

    if (lastBlock) {
      if (lastBlock.classList.contains('block-cta')) {
        lastBlock.classList.add('no-margin');
      }
    }
  }

  function contentStart() {
    const header = document.querySelector('#main-header');
    const content = document.querySelector('.page-content > section:first-child');
    const newDiv = document.createElement('div');
    const contentStart = document.createElement('a');

    newDiv.setAttribute('id', 'contentstart');
    contentStart.setAttribute('href', '#contentstart');
    contentStart.textContent = 'Skip to main content';
    contentStart.classList.add('skip-main');

    if (content && page) {
      content.parentElement.insertBefore(newDiv, content);
      header.parentElement.insertBefore(contentStart, header);
    }
  }

  function mobileModal() {
    const programModal = document.querySelector('#program-mobile-modal');
    const buttonTrigger = document.querySelector('.program-filters__trigger-mobile');
    const closeTriggers = document.querySelectorAll('.program-filters__mobile-close');
    const firstFilter = document.querySelector('#select-program_type');

    if (programModal && buttonTrigger && firstFilter) {
      buttonTrigger.addEventListener('click', function() {
        firstFilter.focus();
      });

      closeTriggers.forEach(closeTrigger => {
        closeTrigger.addEventListener('click', function() {
          buttonTrigger.focus();
        });
      });

      window.addEventListener('keydown', function(e) {
        if ((e.keyCode === 27 || e.key === 'Escape') && programModal.classList.contains('active')) {
          programModal.classList.remove('active');
          buttonTrigger.focus();
        }
      });
    }
  }

  function imageFocus() {
    const elements = document.querySelectorAll('.post-card__thumbnail > a, .program-card__thumbnail > a, .blog-post__card-thumbnail > a');

    if (elements) {
      elements.forEach(element => {
        element.addEventListener('focus', function() {
          element.classList.add('focused');
        });

        element.addEventListener('focusout', function() {
          element.classList.remove('focused');
        });
      });
    }
  }

  function tablePress() {
    const tables = document.querySelectorAll('.tablepress');

    if (tables) {
      tables.forEach(table => {
        const tableHeaders = table.querySelectorAll('th');
        const prevEl = table.previousElementSibling;

        if (tableHeaders) {
          tableHeaders.forEach(tableHeader => {
            tableHeader.setAttribute('scope', 'col');
          });
        }

        if (prevEl && prevEl.tagName === 'H2') {
          const tableCaption = document.createElement('caption');
          const prevElHTML = prevEl.innerHTML;

          tableCaption.innerHTML = prevElHTML;
          table.insertBefore(tableCaption, table.childNodes[0]);
        }
      });
    }
  }

  function searchPage() {
    const body = document.body;
    const searchResults = document.querySelector('.search-results-info');

    if (body.classList.contains('search') && searchResults) {
      const searchResultsText = searchResults.getAttribute('data-results');
      
      setTimeout(function() {
        searchResults.querySelector('span').innerHTML = searchResultsText;
      }, 1000);
    }
  }

  function tempCleanup() {
    const body = document.querySelector('body');
    const videoBlocks = document.querySelectorAll('.block-gallery-video');
    const photoBlocks = document.querySelectorAll('.block-gallery-lightbox');

    if (body.classList.contains('page-id-129') && videoBlocks && photoBlocks) {
      videoBlocks.forEach(videoBlock => {
        videoBlock.remove();
      });

      photoBlocks.forEach(photoBlock => {
        photoBlock.remove();
      });
    }
  }

  function init() {
    console.log('init wcagHelper');
    removeNavIds();
    blockIds();
    anchorLinkMenu();
    topLevelNav();
    tribesFilterBar();
    iframes();
    //selectAll();
    tabIndex();
    newsletterCleanup();
    accordions();
    tabs();
    programSelectMenus();
    blockGalleryVideo();
    blockGalleryLightbox();
    contentStart();
    mobileModal();
    imageFocus();
    tablePress();
    searchPage();
    tempCleanup();
  }

  window.addEventListener('DOMContentLoaded', init);
}

export default wcagHelper;