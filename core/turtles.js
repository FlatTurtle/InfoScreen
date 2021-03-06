/*
 * This turtle manager is the core of the flatturtle framework. 
 * It lets you create turtle objects and allows event manipulation.
 */

function TurtleManager() {
	modules = {};
	instances = {};

	// trigger an event for one or all turtles
	this.trigger = function(module, event) {
		if (event == null) {
			event = module;
			_(instances).each(function(instance, instanceid) {
				if (typeof instance.collection == "object")
					instance.collection.trigger(event);
				if (typeof instance.view == "object")
					instance.view.trigger(event);
			});
		} else {
			_(instances).each(function(instance, instanceid) {
				if (instance.module == module) {
					if (typeof instance.collection == "object")
						instance.collection.trigger(event);
					if (typeof instance.view == "object")
						instance.view.trigger(event);
				}
			});
		}
	}

	// bind an external function to an event for one or all turtles
	this.bind = function(module, event, func) {
		if (func == null) {
			func = event;
			event = module;
			_(instances).each(function(instance, instanceid) {
				if (typeof instance.collection == "object")
					instance.collection.bind(event, func);
				if (typeof instance.view == "object")
					instance.view.bind(event, func);
			});
		} else {
			_(instances).each(function(instance, instanceid) {
				if (instance.module = module) {
					if (typeof instance.collection == "object")
						instance.collection.bind(event, func);
					if (typeof instance.view == "object")
						instance.view.bind(event, func);
				}
			});
		}
	}

	// register a turtle module
	this.register = function(type, module) {
		if (modules[type] != null)
			throw Error("Turtle already registered");
		else if (typeof module != "object")
			throw Error("Cannot register turtle '" + type + "', invalid module");
		else
			modules[type] = module;
		
		return true;
	}

	// check if a turtle is registered
	this.registered = function(type) {
		return modules[type] != null;
	}

	// creates turtle instances
	this.instantiate = function(type, id, options) {
		if (modules[type] == null)
			throw Error("turtle does not exist");
		else {
			if (options == null || typeof options != "object")
				options = {};

			// fetch module description
			module = modules[type];

			var instance = {};

			// save module name
			instance.module = type;

			// construct model
			instance.model = module.model;

			// construct collection
			if (typeof module.collection == "function") {
				if (module.models != null && module.models.constructor == Array)
					instance.collection = new module.collection(module.models, options);
				else
					instance.collection = new module.collection(null, options);
			} else if (typeof module.collection == "object") {
				instance.collection = module.collection;
				instance.models = module.models;
			}
			
			// check if model is assigned
			if (instance.collection != null && instance.collection.model == null && instance.model != null)
				instance.collection.model = instance.model;

			// assign options to collection if not set
			if(instance.collection != null)
				instance.collection.options = options;

			// construct view
			if (typeof module.view == "function") {
				instance.view = new module.view(_.extend(options, {
					collection : instance.collection,
					model : instance.model
				}));
			} else if (typeof module.view == "object") {
				instance.view = module.view;

				if (instance.view.collection == null)
					instance.view.collection = instance.collection;

				if (instance.view.model == null)
					instance.view.model = instance.model;

				// override el with el passed by options
				if (options.el != null)
					instance.view.setElement(options.el);

				// add options to view
				instance.view.options = _.extend(instance.view.options, options);
			}
			
			// trigger born event
			if (typeof instance.collection == "object")
				instance.collection.trigger("born");
			if (typeof instance.view == "object")
				instance.view.trigger("born");

			instances[id] = instance;
			return instance;
		}
		return false;
	}

	// destroy a turtle instance, the 'destroy' event is triggered on the turtle
	this.destroy = function(id) {
		if (instance = instances[id]) {
			
			// trigger destroy event
			if (typeof instance.collection == "object")
				instance.collection.trigger("destroy");
			if (typeof instance.view == "object")
				instance.view.trigger("destroy");
			
			if (instance.collection != null && instance.collection.models != null) {
				_(instance.collection.models).each(function(model) {
					model.destroy();
				});
			}
			delete instance.collection;
			delete instance.view;
			delete instance.model;
			delete instances[id];
		}
	}
}

// basic grow function, we override this in our custom loader
TurtleManager.prototype.grow = function(type, id, options) {
	return this.instantiate(type, id, options);
}