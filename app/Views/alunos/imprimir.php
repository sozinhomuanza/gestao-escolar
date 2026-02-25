<style>
    .report-body { 
        background-color: white !important; 
        padding: 30px; 
        font-family: "Times New Roman", Times, serif; 
        color: #000;
    }

    /* Estrutura do Topo */
    .official-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end; 
        margin-bottom: 25px; 
    }

    /* Bloco da Esquerda: Logotipo da Escola + Visto */
    .left-visto-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 240px;
    }

    .school-logo {
        width: 65px; /* Logotipo da Escola */
        height: auto;
        margin-bottom: 8px;
    }

    .visto-box { 
        border: 1px solid #000; 
        padding: 10px; 
        text-align: center; 
        width: 100%; 
        font-size: 11px;
        line-height: 1.5;
    }

    .signature-line { 
        margin: 35px auto 5px auto; 
        border-top: 1px solid #000; 
        display: block; 
        width: 85%; 
    }

    /* Cabeçalho Central: Insígnia da República */
    .central-header { 
        text-align: center; 
        flex-grow: 1; 
    }

    .insignia-republica {
        width: 70px; /* Insígnia de Angola no centro */
        height: auto;
        margin-bottom: 10px;
    }

    .central-header h1 { font-size: 14px; margin: 2px 0; font-weight: bold; }
    .central-header h2 { font-size: 12px; margin: 2px 0; font-weight: bold; }
    .central-header h3 { font-size: 11px; margin: 2px 0; font-weight: normal; }
    
    .info-labels { margin-top: 12px; font-size: 11px; font-weight: bold; }
    .title-underline { 
        font-size: 13px; 
        margin-top: 15px; 
        font-weight: bold; 
        text-decoration: underline; 
        text-transform: uppercase; 
    }

    /* Tabela */
    .table-official { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 20px; 
    }
    .table-official th, .table-official td { 
        border: 1px solid #000; 
        padding: 6px 8px; 
        font-size: 11px; 
    }
    .table-official th { background-color: #f2f2f2 !important; text-align: center; }

    @media print {
        @page { size: portrait; margin: 1.5cm; }
        .btn-print, .main-sidebar, .main-header, .main-footer { display: none !important; }
        .content-wrapper { margin-left: 0 !important; padding: 0 !important; border: none !important; }
    }
</style>

<div class="content-wrapper report-body">
    <div class="text-right mb-4">
        <button onclick="window.print()" class="btn btn-primary btn-print">
            <i class="fas fa-print"></i> Imprimir Documento Oficial
        </button>
    </div>

    <div class="official-header">
        <div class="left-visto-container">
            <img src="https://www.bing.com/th/id/OIP.HntJM2o6Oa20MWChOOSrqwHaHa?w=204&h=211&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" 
                 alt="Logotipo Escola" class="school-logo">
            <div class="visto-box">
                VISTO<br>O SUB-DIRECTOR PEDAGÓGICO
                <span class="signature-line"></span>
                <strong>MENDES ANTÓNIO DINÍS</strong>
            </div>
        </div>

        <div class="central-header">
            <img src="https://th.bing.com/th/id/OIP.pM_9PbGxgrkMvyVVCcPhPAHaJG?w=155&h=191&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" 
                 alt="Insígnia República" class="insignia-republica">
            
            <h1>INSTITUTO POLITÉCNICO INDUSTRIAL Nº 6081 "17 DE DEZEMBRO"</h1>
            <h2>SUBDIRECÇÃO PEDAGÓGICA</h2>
            <h3>ÁREA DE FORMAÇÃO DE INFORMÁTICA</h3>
            <h3>CURSO TÉCNICO DE INFORMÁTICA</h3>
            
            <div class="info-labels">
                TURMA: <?= mb_strtoupper($nome_turma ?? '_________') ?> | PERÍODO: _________ | ANO LECTIVO: 2026/2027
            </div>

            <div class="title-underline">LISTA NOMINAL DOS ALUNOS</div>
        </div>
        
        <div style="width: 240px;"></div>
    </div>

    <table class="table-official">
        <thead>
            <tr>
                <th style="width: 40px;">Nº</th>
                <th>NOME COMPLETO</th>
                <th style="width: 100px;">GÉNERO</th>
                <th style="width: 200px;">E-MAIL / CONTACTO</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($alunos)): $i = 1; foreach ($alunos as $aluno): ?>
                <tr>
                    <td style="text-align: center;"><?= $i++ ?></td>
                    <td><?= mb_strtoupper(esc($aluno['nome'])) ?></td>
                    <td style="text-align: center;"><?= $aluno['genero'] ?? '---' ?></td>
                    <td><?= $aluno['email'] ?? ($aluno['telefone'] ?? '---') ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="4" class="text-center py-3">Nenhum registo encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 40px; text-align: right; font-size: 12px;">
        Luanda, aos <?= date('d') ?> de <?= date('m') ?> de <?= date('Y') ?><br><br><br>
        <div style="text-align: center; display: inline-block; width: 250px;">
            O Secretário Académico<br>
            ________________________________<br>
            <small>(Assinatura Legível)</small>
        </div>
    </div>
</div>