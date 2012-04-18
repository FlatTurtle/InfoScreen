;//no idea why we need this here. It doesn't work without it.
function cronJobs(jobs){
    $.each(jobs,function(i,job){
        executeJob(job,  Math.round((new Date()).getTime() / 1000), false);
    });

    function executeJob(job, previousTime, now){
        //execute job when it has to be executed
        if(now){
            try{
                eval(job.javascript);
            }catch(err){
                //do nothing
            }
        }
        //set next job
        var interval = getNextUnixtimeFromEntry(job.minutes,job.hours,job.day_of_month, job.month, job.day_of_week);
        setTimeout(function(){executeJob(job, Math.round((new Date()).getTime() / 1000),true);}, interval*1000);
    }

    /**
     * @return next time in seconds
     */ 
    function getNextUnixtimeFromEntry(previousTime, minutes, hours, dayOfMonth, month, dayOfWeek){
        var pt = new Date(previousTime*1000);
        var jobtabMinutes = parseMinutes(minutes, pt.getMinutes());
        var jobtabHours = parseHours(hours, pt.getHours());
        var jobtabDaysOfMonth = parseDaysOfMonth(dayOfMonth, pt.getDate());
        var jobtabMonth = parseMonth(month, pt.getMonth());
        var jobtabDaysOfWeek = parseDaysOfWeek(dayOfWeek, pt.getDay());
        return jobtabMinutes + jobtabHours + jobtabDaysOfMonth + jobtabMonth + jobtabDaysOfWeek;
    }

    /** all functions down here return the seconds until next execution **/
    function parseMinutes(str,previous){
        if(str.indexOf(",") != -1){
            //todo: split all entries and calculated absolute minimum
        }else if(str.indexOf("/") != -1){
            //todo: split, take second part and calculated seconds to it
        }else if(str.indexOf("*") != -1){
            return 60 - (new Date()).getSeconds();
        }else{
            return ((str - previous) * 60);
        }
    }

    function parseHours(str,previous){
        if(str.indexOf(",") != -1){
            //todo: split all entries and calculated absolute minimum
        }else if(str.indexOf("/") != -1){
            //todo: split, take second part and calculated seconds to it
        }else if(str.indexOf("*") != -1){
            return 0;
        }else if(str.indexOf("-") != -1){
            //todo: calculate seconds until at start interval. if in interval, return 0
        }else{
            return ((str - previous) * 3600);
        }
    }

    function parseDaysOfMonth(str,previous){
        //TODO
        return 0;
    }

    function parseMonth(str,previous){
        //TODO
        return 0;
    }

    function parseDaysOfWeek(str,previous){
        //TODO
        return 0;
    }
}