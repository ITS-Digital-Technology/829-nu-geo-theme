import React, {useState, useEffect} from 'react';
import SimpleBar from 'simplebar-react';

function FilterContainer(props) {
  const {
    className,
    label,
    selected,
    taxSlug,
    scrollable,
    collapsible,
    terraDotta,
    postType,
    filterId
  } = props;

  const collapseClass = collapsible ? 'collapsible' : '';
  const [open, setOpen] = useState(false);
  const [count, setCount] = useState(0);
  let content;
  let labelcontent;
  let modalInfo;

  function countClass() {
    let classString = '';

    if (count > 0) {
      classString = 'count-visible';
    }

    return classString;
  }

  function updateCount() {
    if (selected && taxSlug && selected.hasOwnProperty(taxSlug)) {
      setCount(selected[taxSlug].length);
    }
  }

  function toggleOpen() {
    if (collapsible) {
      setOpen(!open);
    }
  }

  function toggleClass() {
    let classString = '';

    if (open) {
      classString = 'open';
    }

    return classString;
  }

  if (scrollable) {
    content = <SimpleBar>{props.children}</SimpleBar>
  }
  else {
    content = props.children;
  }

  if (label) {
    labelcontent = <h6 onClick={() => toggleOpen()} className={countClass()} data-count={count}>
      <span>{label}</span>{(terraDotta && terraDotta.title && terraDotta.text) && <button className="btn-info" aria-label={`${label} Button Info`} onClick={(e) => {toggleTerraModal(e)}}>
        <span className="icon-information-button"></span>
      </button>}
    </h6>
  }

   useEffect(() => {
    updateCount();
  }, [selected]);

  function toggleTerraModal(e) {
      e.preventDefault();
      const infoModals = document.querySelectorAll('.info-modal');
      const infoModal = e.target.closest('.eight29-filter').querySelector('.info-modal');
      const infoModalTitle = infoModal.querySelector('h4');
      const infoModalClose = infoModal.querySelector('.info-modal__close');

      if (!infoModal.classList.contains('active')) {
        infoModal.classList.add('active');
        infoModal.focus();
        document.body.classList.add('lock-scroll');
        document.body.addEventListener('keydown', function(e) {
          if (e.key === 27 || e.key === 'Escape') {
            infoModal.classList.remove('active');
            document.body.classList.remove('lock-scroll');
          }
        });
      } 
      else {
        infoModals.forEach(el => el.classList.remove('active'));
        document.body.classList.remove('lock-scroll');
      }
  }

  const terraDottaText = terraDotta ? (terraDotta.text && terraDotta.text) : null;
  const terraDottaTitle = terraDotta ? (terraDotta.title && terraDotta.title) : null;

  modalInfo = <div className="info-modal">
        <div className="container">
            <div className="info-modal__wrapper">
                <div className="info-modal__title-wrapper">
                    <h4>{terraDottaTitle}</h4>
                    <button className="info-modal__close" onClick={(e) => {toggleTerraModal(e)}} aria-label=""><span className="icon-close"></span></button>
                </div>
                <div className="info-modal__text-wrapper">
                    <div className="info-modal__text"dangerouslySetInnerHTML={{__html: terraDottaText}}>
                    </div>
                </div>
            </div>
        </div>
    </div>

  return(
    <div id={filterId} className={`eight29-filter ${className}`}>
      <div className={`accordion-select ${toggleClass()} ${collapseClass}`}>
        {labelcontent}
        <div>
          {content}
        </div>
      </div>
      {terraDotta && modalInfo}
    </div>
  )
}

export default FilterContainer;