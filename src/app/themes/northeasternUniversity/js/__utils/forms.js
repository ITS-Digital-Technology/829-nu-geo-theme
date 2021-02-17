const $ = jQuery.noConflict();

const forms = {
    wrapper: $('.gform_wrapper'),
    select() {
        // Apply select2 plugin to gform select fields
        const selectFields = this.wrapper.find("select:not([multiple='multiple']:not([class*=select2]))");

        if (selectFields.length) {
            selectFields.each((i, select) => {
                const selectSingle = $(select);
                const placeholder = selectSingle.children('.gf_placeholder');
                selectSingle.select2({
                    minimumResultsForSearch: Infinity,
                    width: '100%',
                    escapeMarkup: function (m) { return m; }
                });

                selectSingle.on('select2:close', () => {
                    $('.select2-selection--single').blur();
                });

                $(window).on('resize', () => {
                    selectSingle.select2('close');
                });
            });
        }


        $(".gform_wrapper select[multiple='multiple']").select2MultiCheckboxes({
            placeholder: "Select Item",
            templateSelection: function (selected, total) {
                return selected.length ? (typeof selected === 'object' ? selected.join(', ') : selected) : "Select Item";
            }
        });
    },
};

export default forms;