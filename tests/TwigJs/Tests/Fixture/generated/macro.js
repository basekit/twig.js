/**
 * @fileoverview Compiled template for file
 *
 * Tests/Fixture/templates/macro.twig
 *
 * @suppress {checkTypes|fileoverviewTags}
 */

goog.provide('macro');

goog.require('twig');
goog.require('twig.filter');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
macro = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(macro, twig.Template);

/**
 * @inheritDoc
 */
macro.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
macro.prototype.render_ = function(sb, context, blocks) {
    blocks = typeof(blocks) == "undefined" ? {} : blocks;
};

// line 1
/**
 * Macro "macro_test"
 *
 * @param {*} opt_arg1
 * @param {*} opt_arg2
 * @return {string}
 */
macro.prototype.macro_macro_test = function(opt_arg1, opt_arg2) {
    var context = twig.extend({}, {"arg1":opt_arg1,"arg2":opt_arg2}, this.env_.getGlobals());

    var sb = new twig.StringBuffer;
    // line 2
    sb.append("    ");
    context["arg3"] = ((("arg2" in context)) ? (twig.filter.def(opt_arg2, "")) : (""));
    // line 3
    sb.append("    ");
    sb.append(twig.filter.escape(this.env_, opt_arg1, "html", null, true));
    sb.append("\n    ");
    // line 4
    if (!(twig.empty(("arg3" in context ? context["arg3"] : null)))) {
        sb.append(twig.filter.escape(this.env_, ("arg3" in context ? context["arg3"] : null), "html", null, true));
    }

    return new twig.Markup(sb.toString());
};

/**
 * @inheritDoc
 */
macro.prototype.getTemplateName = function() {
    return "macro";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
macro.prototype.isTraitable = function() {
    return false;
};
