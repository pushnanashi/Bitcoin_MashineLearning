#!/usr/bin/perl                                                                 
use warnings;

my $txt = $ARGV[0];

if(!$txt){
    print "引数がありません";
    exit;
}

@alldate;
@afterall;

open(DATAFILE, "< ".$txt) or die("error :$!");

while (my $line = <DATAFILE>){
    chomp($line);
    my ($date,$a2,$a3,$a4,$a5,$a6,$a7,$a8) = split(/,/, $line);
    push @alldate,$date;
    push @afterall,$a2.",".$a3.",".$a4.",".$a5.",".$a6.",".$a7.",".$a8;
    print $date."\n";
}



open(FILE, ">", "data.csv") or die("Error:$!");
foreach my $i(0 .. $#alldate){

    $cmd =  "date +%s --date \"".$alldate[$i]." 00:00\"";
    print $cmd."\n";
    $UT = `$cmd`;
    chomp($UT);
    print FILE $UT.",".$afterall[$i]."\n";
}


