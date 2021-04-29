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

  function topLevelNav() {
    const menuItems = document.querySelectorAll('.main-header__mobile ul > li > a, .main-header__right ul > li > a');

    if(menuItems) {
      menuItems.forEach(menuItem => {
        if (menuItem.getAttribute('href') === '#') {
          const label = menuItem.textContent;

          menuItem.removeAttribute('href');
          menuItem.classList.add('menu-trigger'); 
          menuItem.setAttribute('aria-label', `Toggle ${label} dropdown menu`);
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
  }

  function addToAny() {
    const socialLinks = document.querySelectorAll('.a2a_kit a:not(.addtoany_share)');
    const shareLink = document.querySelector('.addtoany_share');

    if(socialLinks) {
      socialLinks.forEach(socialLink => {
        const title = socialLink.getAttribute('title');

        if (title) {
          socialLink.setAttribute('aria-label', `Connect on ${title}`);
        }
      });
    }
    
    if(shareLink) {
      shareLink.setAttribute('aria-label', 'Share this page');
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
      rightMenuButton.setAttribute('tabIndex', "0");
      
      if (rightMenuButton) {
        rightMenuButton.addEventListener('keypress', function(e) {
          if (e.key === 13 || e.key === 'Enter') {
            rightMenuButton.classList.toggle('active');
          }
        });
      }
    }

    //Non React filters
    const filters = document.querySelectorAll('.program-filters__filter');

    if (filters) {
      filters.forEach(filter => {        
        const filterButton = filter.querySelector('button.program-filters__filter-trigger');
        const checkboxes = filter.querySelectorAll('input[type="checkbox"]');
        const filterMenu = filter.querySelector('ul.program-filters__filter-list');
        const filterMenuParentTrigger = filterMenu.closest('.program-filters__filter').querySelector('button.program-filters__filter-trigger');
        const filterLabel = filterMenuParentTrigger.textContent;

        function toggleMenu() {
          const menuStatus = filterMenuParentTrigger.classList.contains('active') ? true : false;
          filterMenuParentTrigger.setAttribute('aria-expanded', menuStatus);
        }

        if (filterMenu) {
          filterMenuParentTrigger.setAttribute('aria-expanded', false);
          filterMenuParentTrigger.setAttribute('aria-haspopup', true);
          filterMenuParentTrigger.setAttribute('aria-label', `Toggle ${filterLabel} filter`);
          filterMenu.setAttribute('role', 'option');
        }

        if (filterButton) {
          filterButton.addEventListener('click', toggleMenu);
        }

        if (checkboxes) {
          checkboxes.forEach(checkbox => {
            checkbox.addEventListener('keypress', function(e) {
              if (e.key === 13 || e.key === 'Enter') {
                checkbox.click();
                filterMenuParentTrigger.setAttribute('aria-expanded', false);
              }
            });

            checkbox.addEventListener('click', function() {
              filterMenuParentTrigger.setAttribute('aria-expanded', false);
            });
          });
        }
      });
    }
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

  function cookieBar() {
    const notice = document.querySelector('#cookie-bar');

    if (notice) {
      notice.setAttribute('aria-label', 'Cookie Notice');
      notice.setAttribute('role', 'main');
    }
  }

  function accordions() {
    const accordions = document.querySelectorAll('.single-accordion');

    if (accordions) {
      accordions.forEach(accordion => {
        let menuStatus = accordion.classList.contains('active') ? true : false;
        const accordionTrigger = accordion.querySelector('.single-accordion__title > h4');

        accordionTrigger.setAttribute('tabindex', 0);
        accordionTrigger.setAttribute('aria-expanded', menuStatus);

        accordionTrigger.addEventListener('click', function() {
          menuStatus = !menuStatus;
          accordionTrigger.setAttribute('aria-expanded', menuStatus);
        });

        accordionTrigger.addEventListener('keypress', function(e) {
          if (e.key === 13 || e.key === 'Enter') {
            accordionTrigger.click();
          }
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

  function init() {
    console.log('init wcagHelper');
    removeNavIds();
    topLevelNav();
    addToAny();
    tribesFilterBar();
    iframes();
    selectAll();
    tabIndex();
    newsletterCleanup();
    cookieBar();
    accordions();
    tabs();
  }

  window.addEventListener('DOMContentLoaded', init);
}

export default wcagHelper;