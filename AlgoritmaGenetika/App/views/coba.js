
'use strict';
const RAM = [100,109,131,1431];//,58,62,72,73,80,91];
const MOTHERBOARD = [502,607,700,823];//,210,230,240,260,290,320];
const POWER_SUPPLY = [101,132,150,1007];//,65,66,70,78,83,85];
const PROCESSOR = [80,90,153,2106];//,510,525,560,589,611,643];
const HARD_DISK = [181,203,300,500];//,97,102,113,124,136,145];
const KOMPONEN = [RAM, MOTHERBOARD, POWER_SUPPLY, PROCESSOR, HARD_DISK];
const JUMLAH_KOMPONEN = 5;
const JUMLAH_PER_KOMPONEN = 4;

function totalHarga(populasi, mode){
    let jumlah = 0, i;
    if(mode === 'random'){
        for(i = 0; i < populasi.length; i++){
            jumlah += parseInt(KOMPONEN[i][populasi[i]]);
        }
    }else if(mode === 'min2'){
        for(i = 0; i < populasi.length - 2; i++){
            jumlah += parseInt(KOMPONEN[i][populasi[i]]);
        }
    }
    
    return jumlah;
}

function checkTotal(populasi){
    let jumlah = 0, i;
    for(i = 0; i < populasi.length - 2; i++){
        jumlah += parseInt(KOMPONEN[i][populasi[i]]);
    }
    return jumlah;
}

function generasiRandom(individu, maksimal) {  
    let populasi, populasi_array, j = 0, k, random, fungsi_fitness, total_biaya;
    populasi_array = [];
    populasi = [];
    while(j < individu){
    //for(j = 0; j < individu; j++){
        populasi_array.push([]);
        total_biaya = 0;
        fungsi_fitness = 0;
        random = 0;
        populasi_array[j] = [];
        for(k = 0; k < JUMLAH_KOMPONEN; k++){
            random = Math.floor((Math.random() * JUMLAH_PER_KOMPONEN));
            populasi_array[j].push(random);
        }
        total_biaya = totalHarga(populasi_array[j],'random');
        if( total_biaya <= maksimal){
            fungsi_fitness = Math.abs(1 - (Math.abs(maksimal - total_biaya) / maksimal));
            populasi_array[j].push(fungsi_fitness);
            populasi_array[j].push(total_biaya);
            populasi.push(populasi_array[j]);
            j = j + 1;
        }
    }
    return populasi;
}

function susunUlang(populasi, maksimal){
    let populasi_generasi, j, i, random, fungsi_fitness, total_biaya;
    populasi_generasi = [];
    for(i = 0; i < populasi.length; i++){
        populasi_generasi.push([]);
        total_biaya = 0;
        fungsi_fitness = 0;
        for(j = 0; j < populasi[i].length - 2; j++){
            populasi_generasi[i].push(populasi[i][j]);
        }
        total_biaya = totalHarga(populasi[i],'min2');
        fungsi_fitness = Math.abs(1 - (Math.abs(maksimal - total_biaya) / maksimal));
        populasi_generasi[i].push(fungsi_fitness);
        populasi_generasi[i].push(total_biaya);
    }
    return populasi_generasi;
}

function kawinSilang(populasi, probabilitas_kawin_silang){
    let populasi_kawin_silang = [],populasi_kawin_silang_temp = [], populasi_induk_terpilih= [], return_populasi = [];
    let i,j,k,total_harga = 0, maksimal = 3000,random_kawin = 0, ke = 0;
    let populasi_temp = [], populasi_temp2 = [], populasi_temp3 = [], populasi_pertama = [], index = [];
    let index_terpilih = [], populasi_co = [];
    populasi_kawin_silang =  populasi.map(function(value){
        return value;
    });
    populasi_kawin_silang_temp =  populasi.map(function(value){
        return value;
    });
    probabilitas_kawin_silang = parseFloat(probabilitas_kawin_silang / 100);
    for(i = 0; i < populasi_kawin_silang.length; i++){
        random_kawin = Math.random();
        if(random_kawin < probabilitas_kawin_silang){
            populasi_induk_terpilih[ke] = (populasi_kawin_silang_temp[i]);
            index_terpilih.push(i);
            ke+=1;
        }
    }
    if(populasi_induk_terpilih.length != 0){
        
        populasi_temp = populasi_induk_terpilih.map(function(value){
            return value;
        });

        populasi_temp2 = populasi_induk_terpilih.map(function(value){
            return value;
        });

        populasi_pertama = populasi_induk_terpilih[0].map(function(value){
            return value;
        });

        for(i = 0; i < populasi_induk_terpilih.length; i++){
            populasi_temp3.push([]);
            random_kawin = Math.floor(Math.random() * JUMLAH_KOMPONEN);
            total_harga = totalHarga(populasi_temp[i], 'min2');
            if(i != populasi_induk_terpilih.length - 1){
                for(j = 0; j < random_kawin; j++){
                    populasi_temp3[i].push(populasi_temp2[i+1][j]);
                }
                for(j = random_kawin; j < populasi_induk_terpilih[i].length; j++){
                    populasi_temp3[i].push(populasi_temp2[i+1][j]);
                }
                if(total_harga < parseInt(totalHarga(populasi_temp3[i],'min2')) && parseInt(totalHarga(populasi_temp3[i],'min2')) <= maksimal){
                    populasi_co.push(populasi_temp3[i]);
                    index.push(i);
                }
            }else{
                for(j = 0; j < random_kawin; j++){
                    populasi_temp3[i].push(populasi_pertama[j]);
                }
                for(j = random_kawin; j < populasi_induk_terpilih[i].length; j++){
                    populasi_temp3[i].push(populasi_pertama[j]);
                }
                if(total_harga < parseInt(totalHarga(populasi_temp3[i],'min2')) && parseInt(totalHarga(populasi_temp3[i],'min2')) <= maksimal){
                    populasi_co.push(populasi_temp3[i]);
                    index.push(i);
                }
            }
        }
        ke = 0;
        if(populasi_co.length != 0){
            for(i = 0; i < populasi_kawin_silang.length; i++){
                for(j = 0; j < index.length; j++){
                    if(index[j] == i){
                        populasi_kawin_silang_temp[i] = populasi_co[ke];
                        ke+=1;
                    }
                }
            }
            return_populasi = populasi_kawin_silang_temp.map(function(value){
                return value;
            });
        }else{
            return_populasi = populasi_kawin_silang_temp.map(function(value){
                return value;
            });
        }
    }else{
        return_populasi = populasi_kawin_silang_temp.map(function(value){
            return value;
        });
    }
    return return_populasi;
}

function mutasi(populasi, probalitas_mutasi){
    let i,j,k,maksimal = 3000,jumlah_gen = 0, mutasi_terjadi = 0, loop = 0;
    let populasi_mutasi = [], populasi_mutasi_temp = [], random_mutasi, mutasi_komponen, sub_jenis, urutan_ke;
    let temp, harga_total;
    populasi_mutasi = populasi.map(function(value){
        return value;
    });
    populasi_mutasi_temp = populasi.map(function(value){
        return value;
    });
    probalitas_mutasi = parseFloat(probalitas_mutasi / 100);
    for(i = 0; i < populasi_mutasi.length; i++){
        for(j = 0; j < populasi_mutasi[i].length - 2; j++){
            jumlah_gen+=1;
        }
    }
    mutasi_terjadi = Math.floor(jumlah_gen * probalitas_mutasi);
    console.log("awal");
    console.log(populasi_mutasi);
    console.log(jumlah_gen);
    while (loop < mutasi_terjadi){
        temp = [];
        random_mutasi = Math.floor(Math.random() * jumlah_gen); //random index
        urutan_ke = Math.ceil(random_mutasi/JUMLAH_KOMPONEN); // array populasi
        if(urutan_ke != 0){
            sub_jenis = Math.abs(parseInt((random_mutasi + JUMLAH_KOMPONEN) - urutan_ke * JUMLAH_KOMPONEN)); //komponen yang termutasi
        }else{
            sub_jenis = 0;
        }
        mutasi_komponen = Math.floor(Math.random() * JUMLAH_PER_KOMPONEN); // random nomor
        console.log('u '+urutan_ke+' s '+sub_jenis+' m '+mutasi_komponen);
        if(sub_jenis != 0){

            for(i = 0; i < populasi_mutasi[urutan_ke - 1].length - 2; i++){
                temp.push(populasi_mutasi[urutan_ke - 1][i]);
            }
            // temp = populasi_mutasi_temp[urutan_ke];
            temp[sub_jenis - 1] = mutasi_komponen;
            console.log('temp : '+loop+' '+totalHarga(temp,'min2')+' asli : '+ populasi_mutasi[urutan_ke - 1][6]+' maksimal : '+maksimal);
            if(parseInt(populasi_mutasi[urutan_ke - 1][6]) < parseInt(totalHarga(temp,'min2')) 
                && parseInt(totalHarga(temp,'min2'))<=maksimal ){
                    populasi_mutasi[urutan_ke - 1][sub_jenis - 1] = mutasi_komponen;
                    harga_total = totalHarga(populasi_mutasi[urutan_ke - 1],'min2');
                    populasi_mutasi[urutan_ke - 1][6] = harga_total;
                    populasi_mutasi[urutan_ke - 1][5] = Math.abs(1 - (Math.abs(maksimal - harga_total) / maksimal));
                    //harus diganti lagi hasilnya
                    console.log('logl'+populasi_mutasi[urutan_ke - 1]);
            }
            console.log('logla '+populasi_mutasi[urutan_ke - 1]);
        }else{
            for(i = 0; i < populasi_mutasi[urutan_ke].length - 2; i++){
                temp.push(populasi_mutasi[urutan_ke][i]);
            }
            // temp = populasi_mutasi_temp[urutan_ke];
            temp[sub_jenis] = mutasi_komponen;
            console.log('temp : '+loop+' '+totalHarga(temp,'min2')+' asli : '+ populasi_mutasi[urutan_ke][6]+' maksimal : '+maksimal);
            if(parseInt(populasi_mutasi[urutan_ke][6]) < parseInt(totalHarga(temp,'min2')) 
                && parseInt(totalHarga(temp,'min2'))<=maksimal ){
                    populasi_mutasi[urutan_ke][sub_jenis] = mutasi_komponen;
                    harga_total = totalHarga(populasi_mutasi[urutan_ke],'min2');
                    populasi_mutasi[urutan_ke][6] = harga_total;
                    populasi_mutasi[urutan_ke][5] = Math.abs(1 - (Math.abs(maksimal - harga_total) / maksimal));
                    console.log('logl'+populasi_mutasi[urutan_ke]);
            }
            console.log('logla '+populasi_mutasi[urutan_ke]);
        }
        loop+=1;
    }
    return populasi_mutasi;
}

let anu = generasiRandom(10,3000);
let iku = kawinSilang(anu, 50);
console.log("diluar");
console.log("iku");
console.log(iku);
let kono  = mutasi(iku, 50);
console.log("kono");
console.log(kono);