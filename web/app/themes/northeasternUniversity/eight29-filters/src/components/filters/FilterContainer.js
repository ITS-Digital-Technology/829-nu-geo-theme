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
    labelcontent = <div className="filter-label">
      <label htmlFor={`select-${filterId}`} onClick={() => toggleOpen()} className={countClass()} data-count={count}>
        {label}
      </label>
      {(terraDotta && terraDotta.title && terraDotta.text) && <span role="img" tabIndex="0" className="btn-info" title={terraDotta.tooltip} aria-label={terraDotta.tooltip}>
          <span className="icon-information-button"></span>
        </span>}
    </div>
  }

   useEffect(() => {
    updateCount();
  }, [selected]);

  const modalId = label ? `modal-${label.replaceAll(' ', '-').toLowerCase()}` : '';

  function toggleTerraModal(e) {
      e.preventDefault();
      const infoModals = document.querySelectorAll('.info-modal');
      const infoModal = e.target.closest('.eight29-filter').querySelector('.info-modal');
      const infoModalTitle = infoModal.querySelector('.info-modal-title');
      const infoModalClose = infoModal.querySelector('.info-modal__close');

      if (!infoModal.classList.contains('active')) {
        infoModal.classList.add('active');
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
            <div className="info-modal__wrapper" id={modalId}>
                <div className="info-modal__title-wrapper">
                    <h4 className="info-modal-title">{terraDottaTitle}</h4>
                    <button className="info-modal__close" onClick={(e) => {toggleTerraModal(e)}} aria-label="Close"><span className="icon-close"></span></button>
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