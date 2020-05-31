<template>
    <div>
        <div class="container-fluid mt-3">
            <div class="row">

                <div class="col-md-6">
                    
                    <div class="card bg-light text-dark mt-3">
                        <div class="card-header">Ordens de Serviço em Aberto
                            <div class="float-right text-info">
                                <a href="/ordem_servico">
                                    <i class="fas fa-link"></i>
                                    Acessar
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <transition name="fade" mode="in-out" appear>
                                <os-em-aberto></os-em-aberto>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
</style>


<style>
.card-body {
    padding: 0 !important;
}
.fade-leave-active,
.fade-enter-active {
    transition: 0.4s ease;
    opacity: 1;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
.card-stats {
    .card-body {
        padding: 15px 15px 0px;

        .numbers {
            font-size: 1.8rem;
            text-align: right;

            p {
                margin-bottom: 0;
            }
        }
    }
    .card-footer {
        padding: 0px 15px 10px 15px;
    }
    .icon-big {
        font-size: 3em;
        min-height: 64px;

        i {
            line-height: 59px;
        }
    }
}
</style>


<script>
import Axios from "axios";
import MovTanque from "./dashboard/MovTanque";
import UltimasEntradasComb from "./dashboard/UltimasEntradasComb";
import CardInfo from "./dashboard/CardInfo";
import OsEmAberto from './dashboard/OsEmAberto';

export default {
    components: {
        
        "ultimas-entradas-comb": UltimasEntradasComb,
        "card-info": CardInfo,
        "os-em-aberto": OsEmAberto
    },
    data() {
        return {
            numVeiculosFrota: 0,
            numAbastecimentosDia: 0
        };
    },
    async mounted() {
        this.getNumVeiculosFrota();
        this.getAbastecimentosDia();
    },
    methods: {
        getNumVeiculosFrota() {
            Axios.get("/dashboard/total_veiculos_frota")
                .then(async r => {
                    this.numVeiculosFrota = r.data.total_veiculos_frota;
                })
                .catch(e => {
                    console.log(e);
                });
        },
        getAbastecimentosDia() {
            Axios.get('/dashboard/abastecimentos_hoje')
                .then(r => {
                    this.numAbastecimentosDia = r.data.abastecimentos_hoje;
                })
                .catch(e => {
                    console.log(e);
                });
        }
    }
};
</script>
