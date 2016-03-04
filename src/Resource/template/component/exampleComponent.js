(function (namespace, app, globals) {


    namespace.exampleComponent = app.newClass({
        extend: function () {
            return app.core.component.abstractComponent;
        }
    });


    /**
     * Component template
     * @returns {jQuery}
     */
    namespace.exampleComponent.prototype.getTemplate = function () {
        var tmplString = app.utils.getString(function () {
            //@formatter:off
            /**<string>
                    <xv-tag-name>
                    </xv-tag-name>
             </string>*/
            //@formatter:on
        });
        return $(tmplString);
    };


    /**
     * Default parameters
     *
     * @returns {{}}
     */
    namespace.exampleComponent.prototype.getDefaultParams = function () {
        return {};
    };


    /**
     * Component constructor
     */
    namespace.exampleComponent.prototype.init = function () {

    };


    /**
     * Executed when component is removing from DOM tree
     */
    namespace.exampleComponent.prototype.destroy = function () {
    };


    return namespace.exampleComponent;
})(__ARGUMENT_LIST__);