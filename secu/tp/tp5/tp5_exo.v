Require Export ZArith.
Open Scope Z.
Require Import Lia.

Inductive expr : Set :=
| Cte : Z -> expr
| Plus : expr -> expr -> expr
| Moins : expr -> expr -> expr
| Mult : expr -> expr -> expr.

Inductive eval : expr -> Z -> Prop :=
| ECte : forall c : Z, eval ( Cte c ) c
| EPlus : forall ( e1 e2 : expr ) ( v1 v2 v : Z ),
  eval e1 v1 -> eval e2 v2 -> v = v1 + v2 ->
  eval ( Plus e1 e2 ) v
| EMoins : forall ( e1 e2 : expr ) ( v1 v2 v : Z ),
  eval e1 v1 -> eval e2 v2 -> v = v1 - v2 ->
  eval ( Moins e1 e2 ) v
| EMult : forall ( e1 e2 : expr ) ( v1 v2 v : Z ),
  eval e1 v1 -> eval e2 v2 -> v = v1 * v2 ->
  eval ( Mult e1 e2 ) v.

Definition e1 := Plus (Cte 1) (Cte 1).

Lemma eval_e1 : eval e1 2.
Proof.
  unfold e1.
  eapply EPlus.
  - apply ECte.
  - apply ECte.
  - simpl. 
    reflexivity.
(**  - lia. **)
Qed.

Definition e2 := (Mult (Plus (Cte 4) (Cte 2)) (Moins (Cte 9) (Cte 2))).

Lemma eval_e2 : eval e2 42.
Proof.
  unfold e2.
  eapply EMult.
  - eapply EPlus.
  -- apply ECte.
  -- apply ECte.
  -- auto.
  - eapply EMoins.
  -- apply ECte.
  -- apply ECte.
  -- simpl. reflexivity.
  - simpl. reflexivity.
Qed.

(** apply_eval **)
Ltac cheating := repeat apply ECte ||
  eapply EPlus ||
  eapply EMoins ||
  eapply EMult ||
  auto ||
  lia.

Lemma eval_e2_with_cheating : eval e2 42.
Proof.
  unfold e2.
  cheating.
Qed.

Fixpoint f_eval (e : expr) : Z :=
  match e with
  | Cte c => c
  | Plus e1 e2 =>
    let v1 := f_eval e1 in
    let v2 := f_eval e2 in
    v1 + v2
  | Moins e1 e2 =>
    let v1 := f_eval e1 in
    let v2 := f_eval e2 in
    v1 - v2
  | Mult e1 e2 =>
    let v1 := f_eval e1 in
    let v2 := f_eval e2 in
    v1 * v2
  end.

Eval compute in f_eval (Plus (Cte 1) (Cte 1)).
Eval compute in f_eval (Mult (Plus (Cte 4) (Cte 2)) (Moins (Cte 9) (Cte 2))).


Theorem mon_theroem : forall e : expr, forall v : Z, f_eval e = v -> eval e v.
Proof.
  induction e.
  intros.
  (* Cas Cte *)
  simpl in H.
  rewrite <- H.
  apply ECte.
  (* Cas Plus *)
  intros.
  simpl in H.
  rewrite <- H.
  (** 
    eapply Eplus.
    apply IHe1.
    auto.
    apply IHe2.
    auto.
    reflexivity.
  **)
  apply (EPlus _ _ (f_eval e3) (f_eval e4)).
  apply IHe1; reflexivity.
  apply IHe2; reflexivity.
  reflexivity.
  (* Cas Moins *)
  intros.
  simpl in H.
  rewrite <- H.
  apply (EMoins _ _ (f_eval e3) (f_eval e4)).
  apply IHe1; reflexivity.
  apply IHe2; reflexivity.
  reflexivity.
  (* Cas Mult *)
  intros.
  simpl in H.
  rewrite <- H.
  apply (EMult _ _ (f_eval e3) (f_eval e4)).
  apply IHe1; reflexivity.
  apply IHe2; reflexivity.
  reflexivity.
Qed.




Require Import FunInd.

Functional Scheme f_eval_ind := Induction for f_eval Sort Prop.

Theorem completude : forall e : expr, forall v : Z, eval e v -> f_eval e = v.
Proof.
  intros.
  elim H; intros.
  - simpl. reflexivity.
  - rewrite <- H1 in H4. rewrite <- H3 in H4. rewrite H4. simpl. reflexivity.






  functional induction (f_eval e) using f_eval_ind.
  (* Cas Cte *)
  intros.
  rewrite <- H.
  apply Cte.
  (* Cas Plus *)
  intros.
  rewrite <- H.
  apply (EPlus _ _ (f_eval e3) (f_eval e4)).
  apply IHz; reflexivity.
  apply IHz0; reflexvity.
  reflexvitiy.
Qed.




intro.
functional induction (f_eval e) f_eval using f_eval_ind; intros.