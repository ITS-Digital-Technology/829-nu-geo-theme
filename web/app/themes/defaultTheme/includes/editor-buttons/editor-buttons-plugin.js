(function($) {
    tinymce.create('tinymce.plugins.default_theme', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            // Images buttons
            ed.addButton('images', {
                text: 'Images',
                title: 'Images Shortcodes',
                type: 'menubutton',
                menu: [
                    {
                        text: 'Content Image',
                        onclick: function() {
                            ed.windowManager.open( {
                                title: 'Image Settings',
                                body: [
                                    {
                                        type   : 'listbox',
                                        name   : 'imgAlignment',
                                        label  : 'Image Alignment: ',
                                        values : [
                                            { text: 'None', value: 'none' },
                                            { text: 'Left', value: 'left' },
                                            { text: 'Right', value: 'right' },
                                        ],
                                        value : 'none'
                                    },
                                    {
                                        type   : 'listbox',
                                        name   : 'spacing',
                                        label  : 'Spacing: ',
                                        values : [
                                            { text: 'Normal', value: 'normal' },
                                            { text: 'None', value: 'none' }
                                        ],
                                        value : 'normal'
                                    }
                                ],
                                onsubmit: function( e ) {
                                    ed.insertContent( '[content_image align="' + e.data.imgAlignment + '" spacing="' + e.data.spacing + '"]' + ed.selection.getContent() + '[/content_image]');
                                }
                            });
                        },
                    },
                    {
                        text: 'Full Width Image',
                        onclick: function() {
                            ed.insertContent( '[full_width_image]' + ed.selection.getContent() + '[/full_width_image]');
                        },
                    },
                ]
            });

            // Elements button
            ed.addButton('elements', {
                text: 'Elements',
                title: 'Page Elements Shortcodes',
                type: 'menubutton',
                menu: [
                    {
                        text: 'Full Width Container',
                        onclick: function (e) {
                            ed.insertContent( '[full_width]' + ed.selection.getContent() + '[/full_width]');
                        }
                    },
                    {
                        text: 'Accordions',
                        menu: [
                            {
                                text: 'Accordion Wrapper',
                                onClick: function () {
                                    ed.insertContent( '[accordion_wrapper]' + ed.selection.getContent() + '[/accordion_wrapper]');
                                }
                            },
                            {
                                text: 'Accordion',
                                onClick: function () {
                                    ed.windowManager.open( {
                                        title: 'Accordion Settings',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Accordion title: '
                                            },
                                            {
                                                type   : 'listbox',
                                                name   : 'state',
                                                label  : 'Accordion State: ',
                                                values : [
                                                    { text: 'Closed', value: 'closed' },
                                                    { text: 'Open', value: 'open' }
                                                ],
                                                value : 'closed'
                                            },
                                        ],
                                        onsubmit: function( e ) {
                                            ed.insertContent( '[accordion title="' + e.data.title + '" state="' + e.data.state + '"]' + ed.selection.getContent() + '[/accordion]');
                                        }
                                    });
                                }
                            },
                        ]
                    },
                    {
                        text: 'Lead Paragraph',
                        onclick: function(e) {
                            ed.windowManager.open({
                                title: 'Lead Paragraph Settings',
                                body: [
                                    {
                                        type: 'listbox',
                                        name: 'alignment',
                                        label: 'Alignment: ',
                                        values: [
                                            { text: 'Left', value: 'left' },
                                            { text: 'Right', value: 'right' },
                                            { text: 'Center', value: 'center' }
                                        ]
                                    }
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent( '[leadparagraph alignment="'+ e.data.alignment +'"]' + ed.selection.getContent() + '[/leadparagraph]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Highlight',
                        onclick: function (e) {
                            ed.insertContent( '[highlight]' + ed.selection.getContent() + '[/highlight]');
                        }
                    },
                    {
                        text: 'Dropcap',
                        onclick: function (e) {
                            ed.insertContent( '[dropcap]' + ed.selection.getContent() + '[/dropcap]');
                        }
                    },
                    {
                        text: 'Scroll Hook',
                        onClick: function () {
                            ed.windowManager.open( {
                                title: 'Accordion Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'id',
                                        label: 'ID: '
                                    },
                                ],
                                onsubmit: function( e ) {
                                    ed.insertContent( '[hook id="' + e.data.id + '"]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Button',
                        onClick: function() {
                            ed.windowManager.open({
                                title: 'Button Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'btnUrl',
                                        label: 'Button URL: '
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'style',
                                        label: 'Style: ',
                                        values: [
                                            { text: 'Primary', value: 'primary'},
                                            { text: 'Secondary', value: 'secondary'}
                                        ],
                                        value: 'primary'
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'color',
                                        label: 'Color: ',
                                        values: [
                                            { text: 'Normal', value: 'normal'},
                                            { text: 'Alternative', value: 'alt'}
                                        ],
                                        value: 'normal'
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'btnTarget',
                                        label: 'Open in: ',
                                        values: [
                                            { text: 'New Window', value: '_blank'},
                                            { text: 'Same Window', value: '_self'}
                                        ],
                                        value: 'false'
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'alignment',
                                        label: 'Align: ',
                                        values: [
                                            { text: 'Left', value: 'left'},
                                            { text: 'Center', value: 'center'},
                                            { text: 'Right', value: 'right'}
                                        ],
                                        value: 'left'
                                    }
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent('[button href="' + e.data.btnUrl + '" target="' + e.data.btnTarget + '" style="' + e.data.style + '" alignment="' + e.data.alignment + '" color="' + e.data.color + '"]' + ed.selection.getContent() + '[/button]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Blockquote',
                        onClick: function() {
                            ed.windowManager.open({
                                title: 'Blockquote Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'author',
                                        label: 'Author: '
                                    }
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent('[blockquote author="' + e.data.author + '"]' + ed.selection.getContent() + '[/blockquote]');
                                }
                            });
                        }
                    },

                ]
            });

            // Columns button
            ed.addButton('columns', {
                text: 'Columns',
                title: 'Columns Shortcode',
                onclick: function () {
                    var columns = new Array();
                    for(var i = 0; i <= 12; i++) {
                        columns.push({ text: i, value: i })
                    }

                    ed.windowManager.open( {
                        title: 'Columns Settings',
                        body: [
                            {
                                type   : 'listbox',
                                name   : 'desktop',
                                label  : 'Desktop Columns: ',
                                values : columns,
                                value : 10
                            },
                            {
                                type   : 'listbox',
                                name   : 'tablet',
                                label  : 'Tablet Columns: ',
                                values : columns,
                                value : 10
                            },
                            {
                                type   : 'listbox',
                                name   : 'mobile',
                                label  : 'Mobile Columns: ',
                                values : columns,
                                value : 12
                            },
                            {
                                type   : 'listbox',
                                name   : 'spacingTop',
                                label  : 'Spacing Top: ',
                                values: [
                                    { text: 'True', value: 'true'},
                                    { text: 'false', value: 'false'}
                                ],
                                value: 'true'
                            },
                            {
                                type   : 'listbox',
                                name   : 'spacingBottom',
                                label  : 'Spacing Bottom: ',
                                values: [
                                    { text: 'True', value: 'true'},
                                    { text: 'false', value: 'false'}
                                ],
                                value: 'true'
                            },
                        ],
                        onsubmit: function( e ) {
                            ed.insertContent( '[columns desktop="' + e.data.desktop + '" tablet="' + e.data.tablet + '" mobile="'+ e.data.mobile +'" spacingTop="'+ e.data.spacingTop +'" spacingBottom="'+ e.data.spacingBottom +'"]' + ed.selection.getContent() + '[/columns]');
                        }
                    });
                }
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Default Theme Editor Buttons',
                author : 'Default Theme'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'default_theme', tinymce.plugins.default_theme );
})(jQuery);
