(function() {

	var modules = {};
	var instances = {};

	var trigger = function(id, event) {
		if (event == null) {
			event = id;
			_(instances).each(function(instance, id) {
				if (typeof instance.collection == "object")
					instance.collection.trigger(event);
				if (typeof instance.view == "object")
					instance.view.trigger(event);
			});
		} else {
			if (instance = instances[id]) {
				if (typeof instance.collection == "object")
					instance.collection.trigger(event);
				if (typeof instance.view == "object")
					instance.view.trigger(event);
			}
		}
	}

	var bind = function(id, event, func) {
		if (func == null) {
			func = event;
			event = id;
			_(instances).each(function(instance, id) {
				if (typeof instance.collection == "object")
					instance.collection.bind(event, func);
				if (typeof instance.view == "object")
					instance.view.bind(event, func);
			});
		} else {
			if (instance = instances[id]) {
				if (typeof instance.collection == "object")
					instance.collection.bind(event, func);
				if (typeof instance.view == "object")
					instance.view.bind(event, func);
			}
		}
	}

	// grow a turtle module
	var grow = function(id, module) {
		if (modules[id] != null)
			throw new Error("turtle already alive");
		else if (typeof module != "object")
			throw new Error("cannot grow turtle '" + id
					+ "', invalid growing options");
		else
			modules[id] = module;

		return instantiate(id);
	}

	// creates turtle instances
	var instantiate = function(id) {
		if (modules[id] == null)
			throw new Error("turtle does not exist");
		if (instances[id] != null)
			throw new Error("turtle already alive");

		console.log("creating instance: " + id);

		module = modules[id];

		var instance = {
			boardIndex : 1
		};

		// construct model
		instance.model = module.model;

		// construct collection
		if (typeof module.collection == "function") {
			if (module.models != null && module.models.constructor == Array)
				instance.collection = new module.collection(module.models);
			else
				instance.collection = new module.collection();
		} else if (typeof module.collection == "object") {
			instance.collection = module.collection;
			instance.models = module.models;
		}

		if (instance.collection != null && instance.collection.model == null)
			instance.collection.model = instance.model;

		// construct view
		if (typeof module.view == "function") {
			instance.view = new module.view({
				collection : instance.collection,
				model : instance.model
			});
		} else if (typeof module.view == "object") {
			instance.view = module.view;

			if (instance.view.collection == null)
				instance.view.collection = instance.collection;

			if (instance.view.model == null)
				instance.view.model = instance.model;
		}

		instances[id] = instance;
		trigger(id, "born");

		return true;
	}

	var kill = function(id) {
		if (instance = instances[id]) {
			instance.trigger(id, "destroy");
			if (instance.collection != null
					&& instance.collection.models != null) {
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

	var initialize = function(opts) {
		if (typeof opts == "object")
			settings = _.extend(settings, opts);
	}

	if (!((global = typeof exports !== "undefined" && exports !== null ? exports
			: window).Turtles != null)) {
		global.Turtles = {
			grow : grow,
			kill : kill,
			trigger : trigger,
			bind : bind
		};
	}

})();