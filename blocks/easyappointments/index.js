(function () {
    var el        = wp.element.createElement;
    var Fragment  = wp.element.Fragment;
    var __        = wp.i18n.__;
    var useBlockProps    = wp.blockEditor.useBlockProps;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody  = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var Placeholder = wp.components.Placeholder;

    wp.blocks.registerBlockType('easyappointments/booking', {
        edit: function (props) {
            var attributes   = props.attributes;
            var setAttributes = props.setAttributes;
            var blockProps   = useBlockProps();

            return el(
                Fragment,
                null,

                el(
                    InspectorControls,
                    null,

                    el(
                        PanelBody,
                        {
                            title: __('Display', 'easyappointments'),
                            initialOpen: true
                        },
                        el(TextControl, {
                            label: __('Width', 'easyappointments'),
                            help:  __('CSS value, e.g. 100% or 800px', 'easyappointments'),
                            value: attributes.width,
                            onChange: function (val) { setAttributes({ width: val }); }
                        }),
                        el(TextControl, {
                            label: __('Height', 'easyappointments'),
                            help:  __('CSS value, e.g. 1000px', 'easyappointments'),
                            value: attributes.height,
                            onChange: function (val) { setAttributes({ height: val }); }
                        }),
                        el(TextControl, {
                            label: __('Custom iframe style', 'easyappointments'),
                            help:  __('Optional inline CSS for the iframe element.', 'easyappointments'),
                            value: attributes.iframeStyle,
                            onChange: function (val) { setAttributes({ iframeStyle: val }); }
                        })
                    ),

                    el(
                        PanelBody,
                        {
                            title: __('Pre-selection', 'easyappointments'),
                            initialOpen: false
                        },
                        el(TextControl, {
                            label: __('Provider ID', 'easyappointments'),
                            help:  __('Pre-select a provider by their record ID (found in the Easy!Appointments backend).', 'easyappointments'),
                            value: attributes.provider,
                            onChange: function (val) { setAttributes({ provider: val }); }
                        }),
                        el(TextControl, {
                            label: __('Service ID', 'easyappointments'),
                            help:  __('Pre-select a service by its record ID (found in the Easy!Appointments backend).', 'easyappointments'),
                            value: attributes.service,
                            onChange: function (val) { setAttributes({ service: val }); }
                        })
                    )
                ),

                el(
                    'div',
                    blockProps,
                    el(
                        Placeholder,
                        {
                            icon: 'calendar-alt',
                            label: 'Easy!Appointments'
                        },
                        el(
                            'p',
                            null,
                            __('Your booking form will appear here. Use the settings panel to configure the block.', 'easyappointments')
                        ),
                        attributes.provider || attributes.service
                            ? el(
                                'p',
                                null,
                                attributes.provider
                                    ? el('strong', null, __('Provider ID: ', 'easyappointments'), attributes.provider, ' ')
                                    : null,
                                attributes.service
                                    ? el('strong', null, __('Service ID: ', 'easyappointments'), attributes.service)
                                    : null
                            )
                            : null
                    )
                )
            );
        },

        save: function () {
            return null; // server-side rendered via render_callback in PHP
        }
    });
}());
